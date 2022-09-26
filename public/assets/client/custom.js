// search campaign
$('#select_campaign').keyup(function() {

  let keyword = $(this).val();
  $.ajax({
    url: appUrl + "/api/get-campaigns?search=" + keyword,
    method: 'GET',
    data: {},
    success: function(data) {
      let elements = [];
      if (data.length) {
        $('#campaigns').empty();
        for (let i = 0; i < data.length; i++) {
          elements += `<option value="${data[i].name}">`
        }
        $('#campaigns').append(elements);
      }
    }
  })

});

// add multi smtp account

$(document).on('click', '.add-more-smtp', function(){
    let elementToAppend =  `
   
    <div class="parent-row">
    <hr>
            <div class="form-group">
            <div class="row">
                <div class="col-md-5">
                    <select class="form-control" id="select_host" name="host[]">
                        <option value="0">--Select Host--</option>
                        <option value="smtp.gmail.com">smtp.gmail.com</option>
                        <option value="smtp-mail.outlook.com">smtp-mail.outlook.com</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <input required class="form-control" type="number" name="daily_limit[]" placeholder="Daily Limit">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-5">
                    <input required class="form-control" type="text" name="username[]" placeholder="Username">
                </div>
                <div class="col-md-5">
                    <input required class="form-control" type="password" name="password[]" placeholder="Password">
                </div>
                <div class="col-md-2">
                    <span class="remove-current-smtp custom-hoverable-element fas fa-minus-circle"></span>
                    <span class="add-more-smtp custom-hoverable-element fas fa-plus-circle"></span>
                </div>

            </div>
        </div>
    </div>
    `;

    $(".smtp-group").append(elementToAppend);

    //remove-current-smtp
    $(document).on('click', '.remove-current-smtp', function(){
        $(this).closest('.parent-row' ).remove();
    });

});


