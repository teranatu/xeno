$(function() {
  inRoomUsers();
});

function inRoomUsers() {
  $.ajax({
      url: "result/ajaxInRoomUsersDetails",
      dataType: "json",
      success: data => {
        // console.log(data.inRoomUsers_8);
        // console.log(data.inRoomUsers_8.length);
        let countUsers = data.inRoomUsers_8.length;
        $("#inRoomUsers").find(".user-visible").remove();

        switch (countUsers) {
          case 1:
            for (var i = 0; i < countUsers; i++) {
              countCard1 = data.inRoomUsers_8[i].card_1;
              countCard2 = data.inRoomUsers_8[i].card_2;
              // console.log(countCard1);
              // console.log(countCard2);
              if ( (null !== countCard1) && (null !== countCard2) ) {
                var html = `
                            <div class="col-12 user-visible">
                              <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-4">${data.inRoomUsers_8[i].name}</div>
                                        <div class="col-4 text-center">?</div>
                                        <div class="col-4 text-center">?</div>
                                    </div>
                                </div>
                              </div>
                            </div>
                        `;
              }else if ( (null === countCard1) && (null === countCard2) ) {
                var html = `
                            <div class="col-12 user-visible">
                              <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                      <div class="col-4">${data.inRoomUsers_8[i].name}</div>
                                    </div>
                                </div>
                              </div>
                            </div>
                        `;
              } else {
                var html = `
                            <div class="col-12 user-visible">
                              <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-4">${data.inRoomUsers_8[i].name}</div>
                                        <div class="col-4 text-center">?</div>
                                    </div>
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
              countCard1 = data.inRoomUsers_8[i].card_1;
              countCard2 = data.inRoomUsers_8[i].card_2;
              // console.log(countCard1);
              // console.log(countCard2);
              if ( (null !== countCard1) && (null !== countCard2) ) {
                var html = `
                            <div class="col-12 user-visible">
                              <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-4">${data.inRoomUsers_8[i].name}</div>
                                        <div class="col-4 text-center">?</div>
                                        <div class="col-4 text-center">?</div>
                                    </div>
                                </div>
                              </div>
                            </div>
                        `;
              }else if ( (null === countCard1) && (null === countCard2) ) {
                var html = `
                            <div class="col-12 user-visible">
                              <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                      <div class="col-4">${data.inRoomUsers_8[i].name}</div>
                                    </div>
                                </div>
                              </div>
                            </div>
                        `;
              } else {
                var html = `
                            <div class="col-12 user-visible">
                              <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-4">${data.inRoomUsers_8[i].name}</div>
                                        <div class="col-4 text-center">?</div>
                                    </div>
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
              countCard1 = data.inRoomUsers_8[i].card_1;
              countCard2 = data.inRoomUsers_8[i].card_2;
              // console.log(countCard1);
              // console.log(countCard2);
              if ( (null !== countCard1) && (null !== countCard2) ) {
                var html = `
                            <div class="col-12 user-visible">
                              <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-4">${data.inRoomUsers_8[i].name}</div>
                                        <div class="col-4 text-center">?</div>
                                        <div class="col-4 text-center">?</div>
                                    </div>
                                </div>
                              </div>
                            </div>
                        `;
              }else if ( (null === countCard1) && (null === countCard2) ) {
                var html = `
                            <div class="col-12 user-visible">
                              <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                      <div class="col-4">${data.inRoomUsers_8[i].name}</div>
                                    </div>
                                </div>
                              </div>
                            </div>
                        `;
              } else {
                var html = `
                            <div class="col-12 user-visible">
                              <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-4">${data.inRoomUsers_8[i].name}</div>
                                        <div class="col-4 text-center">?</div>
                                    </div>
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
              countCard1 = data.inRoomUsers_8[i].card_1;
              countCard2 = data.inRoomUsers_8[i].card_2;
              // console.log(countCard1);
              // console.log(countCard2);
              if ( (null !== countCard1) && (null !== countCard2) ) {
                var html = `
                            <div class="col-12 user-visible">
                              <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-4">${data.inRoomUsers_8[i].name}</div>
                                        <div class="col-4 text-center">?</div>
                                        <div class="col-4 text-center">?</div>
                                    </div>
                                </div>
                              </div>
                            </div>
                        `;
              }else if ( (null === countCard1) && (null === countCard2) ) {
                var html = `
                            <div class="col-12 user-visible">
                              <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                      <div class="col-4">${data.inRoomUsers_8[i].name}</div>
                                    </div>
                                </div>
                              </div>
                            </div>
                        `;
              } else {
                var html = `
                            <div class="col-12 user-visible">
                              <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-4">${data.inRoomUsers_8[i].name}</div>
                                        <div class="col-4 text-center">?</div>
                                    </div>
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

  setTimeout("inRoomUsers()", 2000);
}