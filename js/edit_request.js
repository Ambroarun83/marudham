
// Document is ready
$(document).ready(function () {
    // callOnClickEvents();
    
    
    
    
});//document ready end
function callOnClickEvents(){

    setTimeout(() => { console.log('Called on click events')
        // $('.sub_verification').off('click');
        $('.sub_verification').click(function(){
            var req_id = $(this).val();
            var cus_id = $(this).attr('data-value');
            if(confirm('Do You want to Send this Request for Verification?')){
                $.ajax({
                    url: 'requestFile/sendToVerificaiton.php',
                    dataType: 'json',
                    type: 'post',
                    data:{'req_id':req_id,"cus_id":cus_id},
                    cache:false,
                    success:function(response){
                        if(response.includes('Moved')){
                            Swal.fire({
                                timerProgressBar: true,
                                timer: 2000,
                                title: response,
                                icon: 'success',
                                showConfirmButton: true,
                                confirmButtonColor: '#009688'
                            });
                            setTimeout(function(){
                                window.location= 'edit_request';
                            },2000)
                        }
                    }
                })
            }
        });
        // $('a.customer-status').off('click');
        $('a.customer-status').click(function(){event.preventDefault();
            var cus_id = $(this).data('value');
            var req_id = $(this).data('value1');
            $.ajax({
                url:'requestFile/getCustomerStatus.php',
                data: {"cus_id":cus_id},
                // dataType: 'json',
                type:'post',
                cachec: false,
                success: function(response){
                    $('#cusHistoryTable').empty();
                    $('#cusHistoryTable').html(response);
                }
            })
            $.ajax({
                url:'requestFile/getCustomerStatus1.php',
                data: {"cus_id":cus_id,"req_id":req_id},
                type:'post',
                cachec: false,
                success: function(response){
                    $('#exist_type').val(response);
                }
            })
        })
        // $('a.loan-summary').off('click');
        $('a.loan-summary').click(function(){
            var cus_id = $(this).data('value');
            var req_id = $(this).data('value1');
            $.ajax({
                url:'requestFile/getLoanSummary.php',
                data: {"cus_id":cus_id,"req_id":req_id},
                // dataType: 'json',
                type:'post',
                cachec: false,
                success: function(response){
                    $('#loanSummaryTable').empty();
                    $('#loanSummaryTable').html(response);
                }
            })
        });
        
    }, 500);
}
