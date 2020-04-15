$(function() {
  inRoomUsers();
});

function inRoomUsers() {
  $.ajax({
      url: "result/ajaxInRoomUsersDetails",
      dataType: "json",
      success: data => {
        // console.log(data.inRoomUsersDetails_1);
        // console.log(data.inRoomUsersDetails_1.length);
        let countUsers = data.inRoomUsersDetails_1.length;
        $("#inRoomUsers").find(".user-visible").remove();
        switch (countUsers) {
          case 1:
            for (var i = 0; i < countUsers; i++) {
              countCard1 = data.inRoomUsersDetails_1[i].card_1;
              countCard2 = data.inRoomUsersDetails_1[i].card_2;
              // console.log(countCard1);
              // console.log(countCard2);
              if ( (null !== countCard1) && (null !== countCard2) ) {
                var html = `
                <div class="col-12 mt-2 user-visible">
                  <div class="card h-100">
                    <div class="row h-100">
                      <div class="pl-30px col-4 d-flex align-items-center">${data.inRoomUsersDetails_1[i].name}</div>
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
                      <div class="pl-30px col-4 d-flex align-items-center">${data.inRoomUsersDetails_1[i].name}</div>
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
                      <div class="pl-30px col-4 d-flex align-items-center">${data.inRoomUsersDetails_1[i].name}</div>
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
            break;

          case 2:
            for (var i = 0; i < countUsers; i++) {
              countCard1 = data.inRoomUsersDetails_1[i].card_1;
              countCard2 = data.inRoomUsersDetails_1[i].card_2;
              // console.log(countCard1);
              // console.log(countCard2);
              if ( (null !== countCard1) && (null !== countCard2) ) {
                var html = `
                <div class="col-12 mt-2 user-visible">
                  <div class="card h-100">
                    <div class="row h-100">
                      <div class="pl-30px col-4 d-flex align-items-center">${data.inRoomUsersDetails_1[i].name}</div>
                      <div class="col-2 d-flex align-items-center">&#x1f0cf;</div>
                      <div class="col-2 d-flex align-items-center">&#x1f0cf;</div>
                      <div class="col-4 d-flex align-items-center"></div>
                    </div>
                  </div>
                </div>
                `;
              } else if ( (null === countCard1) && (null === countCard2) ) {
                var html = `
                <div class="col-12 mt-2 user-visible">
                  <div class="card h-100">
                    <div class="row h-100">
                      <div class="pl-30px col-4 d-flex align-items-center">${data.inRoomUsersDetails_1[i].name}</div>
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
                      <div class="pl-30px col-4 d-flex align-items-center">${data.inRoomUsersDetails_1[i].name}</div>
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
            break;

          case 3:
            for (var i = 0; i < countUsers; i++) {
              countCard1 = data.inRoomUsersDetails_1[i].card_1;
              countCard2 = data.inRoomUsersDetails_1[i].card_2;
              // console.log(countCard1);
              // console.log(countCard2);
              if ( (null !== countCard1) && (null !== countCard2) ) {
                var html = `
                <div class="col-12 mt-2 user-visible">
                  <div class="card h-100">
                    <div class="row h-100">
                      <div class="pl-30px col-4 d-flex align-items-center">${data.inRoomUsersDetails_1[i].name}</div>
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
                      <div class="pl-30px col-4 d-flex align-items-center">${data.inRoomUsersDetails_1[i].name}</div>
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
                      <div class="pl-30px col-4 d-flex align-items-center">${data.inRoomUsersDetails_1[i].name}</div>
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
            break;

          case 4:
            for (var i = 0; i < countUsers; i++) {
              countCard1 = data.inRoomUsersDetails_1[i].card_1;
              countCard2 = data.inRoomUsersDetails_1[i].card_2;
              // console.log(countCard1);
              // console.log(countCard2);
              if ( (null !== countCard1) && (null !== countCard2) ) {
                var html = `
                <div class="col-12 mt-2 user-visible">
                  <div class="card h-100">
                    <div class="row h-100">
                      <div class="pl-30px col-4 d-flex align-items-center">${data.inRoomUsersDetails_1[i].name}</div>
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
                      <div class="pl-30px col-4 d-flex align-items-center">${data.inRoomUsersDetails_1[i].name}</div>
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
                      <div class="pl-30px col-4 d-flex align-items-center">${data.inRoomUsersDetails_1[i].name}</div>
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
            break;
        }
      },
      error: () => {
          
      }
  });

  setTimeout("inRoomUsers()", 1000);
}