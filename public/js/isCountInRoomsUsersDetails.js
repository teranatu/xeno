$(function() {
  inRoomUsers();
  hasUserCards();
  publicexcuteUser();
});

function inRoomUsers() {
  $.ajax({
      url: "result/ajaxInRoomUsersDetails",
      dataType: "json",
      success: data => {
        // console.log(data.inRoomUsersDetails[0][1].card_1);
        $("#inRoomUsers").find(".user-visible").remove();
        for (let i = 1,ii =1; i < 11; i++,ii+=10) {
          if ( document.getElementById(`Group${ii}`) ) {
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

function hasUserCards() {
  $.ajax({
      url: "result/ajaxInRoomUsersDetails",
      dataType: "json",
      success: data => {
        $("#cardLeft").find(".userid-visible").remove();
        $("#cardRight").find(".userid-visible").remove();
        var today = new Date();
        var d = today.getDate();
        var m = (today.getMonth()+1);
        console.log(d);
        console.log(m);
        for (let i = 1,ii =1; i < 11; i++,ii+=10) {
          if ( document.getElementById(`Group${ii}`) ) {
            for (let j = 1; j < 5; j++) {
              if ( document.getElementById(`Group_number${j}`) ) {
                card1 = data.inRoomUsersDetails[i-1][j-1].card_1 / (d * 7648502312);
                card2 = data.inRoomUsersDetails[i-1][j-1].card_2 / (m * 3241543248);
                console.log(card1);
                html1 = `
                <img class="userid-visible w-60 mt-4" src="http://xenotera.herokuapp.com/xenoCards/xenoCard_${card1}.png">
                `;
                html2 = `
                <img class="userid-visible w-60 mt-4" src="http://xenotera.herokuapp.com/xenoCards/xenoCard_${card2}.png">
                `;
                $("#cardLeft").append(html1);
                $("#cardRight").append(html2);
              }
            }
          }
        }
      },
      error: () => {
      }
  });

  setTimeout("hasUserCards()", 2000);
}

function publicexcuteUser() {
  $.ajax({
      url: "result/ajaxInRoomUsersDetails",
      dataType: "json",
      success: data => {
        $("#inRoomPublicexectute").find(".publicexecutecard_1").remove();
        $("#inRoomPublicexectute").find(".publicexecutecard_2").remove();
        for (let i = 1,ii =1; i < 11; i++,ii+=10) {
          if ( document.getElementById(`Group${ii}`) ) {
            html1 = `
            <img class="publicexecutecard_1 w-50 mt-4" src="http://xenotera.herokuapp.com/xenoCards/xenoCard_${data.inRoomPublicexectute[i-1].publicexecutecard_1}.png">
            `;
            html2 = `
            <img class="publicexecutecard_2 w-50 mt-4" src="http://xenotera.herokuapp.com/xenoCards/xenoCard_${data.inRoomPublicexectute[i-1].publicexecutecard_2}.png">
            `;
            $("#inRoomPublicexectute").append(html1);
            $("#inRoomPublicexectute").append(html2);
          }
        }
      },
      error: () => {
      }
  });

  setTimeout("publicexcuteUser()", 2000);
}