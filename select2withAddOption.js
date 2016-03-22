var tags=['green', 'red', 'blue', 'orange', 'white', 'black'];

$(".follow_up_select_arrow").select2({
    multiple:true,
    query:function(query) {
        var data={results:[]}, 
            results=data.results, 
            t=query.term;

        if (t!==""&&tags.indexOf(t)<0) {
            results.push({id:t, text:t});
        }
        
        $(tags)
         .filter(function() { return this.indexOf(t)>=0; })
         .each(function() { results.push({id:this, text:this}); });

        query.callback(data);
    }
});