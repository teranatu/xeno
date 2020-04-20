$(function() {
  inRoomUsers();
});

function inRoomUsers() {
  $.ajax({
      url: "result/ajaxInRoomUsersDetails",
      dataType: "json",
      success: data => {
        // console.log(data.inRoomUsersDetails[0][1].card_1);
        $("#inRoomUsers").find(".user-visible").remove();
        for (let i = 1; i < 11; i++) {
          if ( document.getElementById(`Group${i}`) ) {
            for (let count = 1; count < 5; count++) {
              let countUsers = data.inRoomUsersDetails[i-1][count-1];
              if (undefined !== countUsers) {
                  countCard1 = data.inRoomUsersDetails[i-1][count-1].card_1;
                  countCard2 = data.inRoomUsersDetails[i-1][count-1].card_2;
                  if ( (null !== countCard1) && (null !== countCard2) ) {
                    var html = `
                    <div class="col-12 mt-2 user-visible">
                      <div class="card h-100">
                        <div class="row h-100">
                          <div class="pl-30px col-4 d-flex align-items-center">${data.inRoomUsersDetails[i-1][count-1].name}</div>
                          <div class="col-2 d-flex align-items-center">&#x1f0cf;</div>
                          <div class="col-2 d-flex align-items-center">&#x1f0cf;</div>
                          <div class="col-4 d-flex align-items-center"></div>
                        </div>
                      </div>
                    </div>
                    `;
                  }else if ( (null === countCard1) && (null === countCard2) ) {
                    var html = `
                    <div class="col-12 mt-2 user-visible">
                      <div class="card h-100">
                        <div class="row h-100">
                          <div class="pl-30px col-4 d-flex align-items-center">${data.inRoomUsersDetails[i-1][count-1].name}</div>
                          <div class="col-2 d-flex align-items-center"></div>
                          <div class="col-2 d-flex align-items-center"></div>
                          <div class="col-4 d-flex align-items-center"></div>
                        </div>
                      </div>
                    </div>
                    `;
                  } else {
                    var html = `
                    <div class="col-12 mt-2 user-visible">
                      <div class="card h-100">
                        <div class="row h-100">
                          <div class="pl-30px col-4 d-flex align-items-center">${data.inRoomUsersDetails[i-1][count-1].name}</div>
                          <div class="col-2 d-flex align-items-center">&#x1f0cf;</div>
                          <div class="col-2 d-flex align-items-center"></div>
                          <div class="col-4 d-flex align-items-center"></div>
                        </div>
                      </div>
                    </div>
                    `;
                  }
                $("#inRoomUsers").append(html);
              }
            }
          }
        }
      },
      error: () => {
          
      }
  });

  setTimeout("inRoomUsers()", 2000);
}