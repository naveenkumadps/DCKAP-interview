$.fn.extend({
    treed: function (o) {
      
      var openedClass = 'fa fa-plus-circle';
      var closedClass = 'fa fa-plus-circle';
      
      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
        closedClass = o.closedClass;
        }
      };
      
        /* initialize each of the top levels */
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').each(function () {
            var branch = $(this);
            branch.prepend("");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                   
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                    task_table(e.target.id)
                    return false;
                }
                else{
                    task_table(e.target.id)
                    return false;
                }
            })
            branch.children().children().toggle();
        });
        /* fire event from the dynamically added icon */
        tree.find('.branch .indicator').each(function(){
            $(this).on('click', function () {
              
                $(this).closest('li').click();
            });
        });
        /* fire event to open branch if the li contains an anchor instead of text */
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
              
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        /* fire event to open branch if the li contains a button instead of text */
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});
/* Initialization of treeviews */
$('#tree1').treed();

function task_table(module) {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        ajax: '/task-view?module_id='+module,
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'summary', name: 'summary'},
            {data: 'action', name: 'action', 
                orderable: false,
              },
        ]
    });
  }
  task_table(0)

  function delete_task(module_id) {
        $.ajax({url: "task-delete/"+module_id, success: function(result){

            $('.delete_block').show();

          $(".delete_block").html( '<button type="button" class="close" data-dismiss="alert">×</button><strong>'+result+'</strong>');

          setTimeout(function(){ $('.delete_block').hide(); }, 3000);
          task_table(0)

        }});
      
  }
  
