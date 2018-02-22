        // -- On est en attente de jQuery
        $(function(){

            //    let mark = {
            //    background  : orange,
            //    color       : black,
            //    }

            // -- 1. Récupération des Articles.
            $.getJSON('https://jsonplaceholder.typicode.com/posts/', function(articles) {
            
            $('header').remove();
            $('article').remove();
            
            var p=document.createElement("p");
            p.innerHTML="Element important à surligner :";
            $(p).prependTo($("main"));




                for(let i=0; i<10;i++)
                {                       
                    $('section ').append($('<header class="context"><h1>' + articles[i].title + '</h1></header><article class="context">' + articles[i].body + '</article>'));       
                }   

                $("#markJS").on("input", function(){
                    $('.context').unmark();
                    $('.context').mark($('#markJS').val()); // will mark the keyword "test", requires an element with class "context" to exist      
                });
                
            });




            //

            //$('<p>je suis en ' + instance + 'surligne' +  </p>');
        });