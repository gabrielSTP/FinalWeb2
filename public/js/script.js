var animationSpeed = 750;
var library = [];

$(document).ready(function () {
    fillLibrary();
    attachAnimations();
});

function fillLibrary() {
    var classlist = [
        "left-side first",
        "left-side",
        "left-side",
        "right-side",
        "right-side",
        "right-side last",
    ];
    booksData.forEach((book, index) => {
        var bookClass = classlist[index % classlist.length];
        var html = `<li class="book ${bookClass}">
                        <div class="cover"><img src="${book.imageUrl}" /></div>
                        <div class="summary">
                            <h1>${book.title}</h1>
                            <h2>by ${book.author}</h2>
                            <p>${book.description}</p>
                        </div>
                    </li>`;
        $(".library").append(html);
    });
}

/* -----------------------------------------------------------------------------
    ANIMATION 
   ---------------------------------------------------------------------------*/
function attachAnimations() {
    $(".book").click(function () {
        if (!$(this).hasClass("selected")) {
            selectAnimation($(this));
        }
    });
    $(".book .cover").click(function () {
        if ($(this).parent().hasClass("selected")) {
            deselectAnimation($(this).parent());
        }
    });
}

function selectAnimation(obj) {
    obj.addClass("selected");
    // elements animating
    var cover = obj.find(".cover");
    var image = obj.find(".cover img");
    var library = $(".library");
    var summaryBG = $(".overlay-summary");
    var summary = obj.find(".summary");

    // animate book cover
    cover.stop().animate(
        {
            width: "300px",
            height: "468px",
        },
        {
            duration: animationSpeed,
        }
    );

    image.stop().animate(
        {
            width: "280px",
            height: "448px",
            borderWidth: "10px",
        },
        {
            duration: animationSpeed,
        }
    );

    // add fix if the selected item is in the bottom row
    if (isBtmRow()) {
        library.stop().animate(
            {
                paddingBottom: "234px",
            },
            {
                duration: animationSpeed,
            }
        );
    }

    // slide page so book always appears
    positionTop();

    // add background overlay
    $(".overlay-page").stop().show();

    // locate summary overlay
    var px = overlayVertPos();
    summaryBG.stop().css("left", px);

    // animate summary elements
    var ht = $(".content").height();
    var pos = obj.position();
    var start = pos.top + 30; // 10px padding-top on .book + 20px padding of .summary
    var speed = Math.round((animationSpeed / ht) * 450); // 450 is goal height

    summaryBG
        .stop()
        .show()
        .animate(
            {
                height: ht + "px",
            },
            {
                duration: animationSpeed,
                easing: "linear",
                step: function (now, fx) {
                    if (now > start && fx.prop === "height") {
                        if (
                            !summary.is(":animated") &&
                            summary.height() < 450
                        ) {
                            summary.show().animate(
                                {
                                    height: "450px",
                                },
                                {
                                    duration: speed,
                                    easing: "linear",
                                }
                            );
                        }
                    }
                },
            }
        );
}

function deselectAnimation(obj) {
    // elements animating
    var cover = obj.find(".cover");
    var image = obj.find(".cover img");
    var library = $(".library");
    var summaryBG = $(".overlay-summary");
    var summary = obj.find(".summary");

    // stop summary animation
    summary.stop();

    // animate book cover
    cover.stop().animate(
        {
            width: "140px",
            height: "224px",
        },
        {
            duration: animationSpeed,
        }
    );

    image.stop().animate(
        {
            width: "140px",
            height: "224px",
            borderWidth: "0px",
        },
        {
            duration: animationSpeed,
            complete: function () {
                obj.removeClass("selected");
            },
        }
    );

    // remove fix for bottom row, if present
    library.stop().animate(
        {
            paddingBottom: "10px",
        },
        {
            duration: animationSpeed,
        }
    );

    // remove background overlay and summary
    var ht = summaryBG.height();
    var pos = obj.position();
    var start = pos.top + 480; //10px of top padding + 470px for .summary height + padding
    var speed = Math.round((animationSpeed / ht) * summary.height());

    summaryBG.stop().animate(
        {
            height: "0px",
        },
        {
            duration: animationSpeed,
            easing: "linear",
            step: function (now, fx) {
                if (now < start && fx.prop === "height") {
                    if (!summary.is(":animated") && summary.height() > 0) {
                        summary.animate(
                            {
                                height: "0px",
                            },
                            {
                                duration: speed,
                                easing: "linear",
                                complete: function () {
                                    summary.hide();
                                },
                            }
                        );
                    }
                }
            },
            complete: function () {
                $(".overlay-page").hide();
                summary.hide(); // catching this twice to insure for aborted animation
                summaryBG.hide();
            },
        }
    );
}

function isBtmRow() {
    var pos = $(".book.selected").position();
    var libHgt = $(".content").height();
    return libHgt - pos.top === 254; // this is current height of the book, plus 30 for padding on the book and library
}

function positionTop() {
    var offset = $(".book.selected").offset();
    var bTop = offset.top;
    $("html, body").stop().animate({ scrollTop: bTop }, animationSpeed);
}

function overlayVertPos() {
    // determines the vertical position for the summary overlay based on selection position
    var pos = $(".book.selected").position();
    switch (pos.left) {
        case 0:
        case 160:
            return "320px";
        case 320:
            return "480px";
        case 480:
            return "0px";
        case 640:
        case 800:
            return "160px";
        default:
            return "0px";
    }
}
/* -----------------------------------------------------------------------------
    BUILD LIBRARY ARRAY 
   ---------------------------------------------------------------------------*/

class Book {
    constructor(imageUrl, title, author, description) {
        this.imageUrl = imageUrl;
        this.title = title;
        this.author = author;
        this.description = description;
    }
}

// Função para montar os dados (adaptado para retornar um array de livros)
function assembleData() {
    return new Promise((resolve, reject) => {
        const connection = mysql.createConnection({
            host: "localhost",
            user: "root",
            password: "",
            database: "web2",
        });

        connection.connect((err) => {
            if (err) {
                return reject("Erro ao conectar ao banco de dados: " + err);
            }

            const sql =
                "SELECT imageUrl, title, author, description FROM books";
            connection.query(sql, (err, results) => {
                if (err) {
                    return reject("Erro ao executar a query: " + err);
                }

                const books = results.map(
                    (row) =>
                        new Book(
                            row.imageUrl,
                            row.title,
                            row.author,
                            row.description
                        )
                );
                resolve(books);
                connection.end();
            });
        });
    });
}
