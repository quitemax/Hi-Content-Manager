$(function () { 
    $(".treeContent").tree({
    	plugins : {
	    	cookie : { 
	    		prefix : "jstree_",
	    		options : { 
		    		path: "<?php echo $this->treeData['cookiePath'];?>"
		    	}

	    	}
	    },
        types : {
            "default" : {
                draggable   : false
            }
        },
        callback : {
        	ondblclk : function (node, tree) { 
                var link = tree.get_node(node).children().get(0).href;
                window.location = link;
            }
            
            //oncreate : function(NODE,REF_NODE,TYPE,TREE_OBJ,RB) {
            //    if(TYPE != "inside") REF_NODE = $(REF_NODE).parents("li:eq(0)");
            //}
            
        }        
    });
});