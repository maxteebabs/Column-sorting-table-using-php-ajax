    $(document).ready(function() {
          var page = parseInt($('#page').val());
          function loadData(page) {
            $.ajax({
              url: 'fetch_ajax.php',
              method: 'post',
              data: {page: page, type: 'populate'},
              dataType: 'json',
              success: function(resp) {
                  $('#records').empty();
                  $('#records').append(resp.data);
                  $('#page').val(page);
              }
            });
          }
          loadData(page);

          $('#search').click(function() {
              var category = $('#record_header').val();
              var field = $('#field').val();
              if(field.length == 0){
                  alert('Empty field'); return false;
              }
               $.ajax({
                url: 'fetch_ajax.php',
                method: 'post',
                data: {page: page, type: 'search', field: field, category: category},
                dataType: 'json',
                success: function(resp) {
                    $('#records').empty();
                    $('#records').append(resp.data);
                }
              });
          });
          $('.paginate').click(function() {
              //get the page
              var page = parseInt($('#page').val());
              var page_type = $(this).attr('data-page');
              if(page_type == 'next') {
                  page = page +1;
              }else if(page_type == 'prev' && page !== 1) {
                   page = page -1;
              }
              loadData(page);

          });
          $(document).on('click', '.sort', function() {
              var sort_type = $(this).attr('data-type');
              var field = $(this).attr('data-table');
              var sort_str;
                if(sort_type == 'desc') {
                  sort_str = '<a class="sort" href="javascript:void(0);" data-table='+field+' data-type="asc">^</a>';
                }else{
                  sort_str = '<a class="sort" href="javascript:void(0);" data-table='+field+' data-type="desc">V</a>';
                }
                //we have to transcend up to the th
                var parent = $(this).parent();
                $(this).remove();
                parent.append(sort_str);
                console.log(parent);

              $.ajax({
                url: 'fetch_ajax.php',
                method: 'post',
                data: {type: 'sort', field: field, sort_type: sort_type},
                dataType: 'json',
                success: function(resp) {
                    $('#records').empty();
                    $('#records').append(resp.data);
                }
              });
          });
          $(document).on('click', '.delete', function() {
              var row = $(this).attr('data-href');  
              $.ajax({
                url: 'fetch_ajax.php',
                method: 'post',
                data: {type: 'deleteRow', row: row},
                dataType: 'json',
                success: function(resp) {
                    $('#records').empty();
                    $('#records').append(resp.data);
                }
              });
          });
      });