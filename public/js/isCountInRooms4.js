$(function() {
  inRoomUsers();
});

function inRoomUsers() {
  $.ajax({
      url: "result/ajaxInRoomUsersDetails",
      dataType: "json",
      success: data => {
        console.log(data.Users);
        $("#inRoomUsers")
        .find(".user-visible")
        .remove();
        // for (var i = 1; i < 11; i++) {
        //   for (var ii = 1; ii < 5; ii++) {
        //     var html = `<p> ${data.Group[i].roomUser[ii].id} </p>
        //                 <div class="col-12 comment-visible">
        //                   <div class="card">
        //                     <div class="card-header">
        //                         <div class="row">
        //                             <p>${data.Group[i].roomUser[ii].name}</p>
        //                         </div>
        //                         <div class="col-6 text-center">${data.Group[i].roomUser[ii].card_1}</div>
        //                         <div class="col-6 text-center">${data.Group[i].roomUser[ii].card_2}</div>
        //                     </div>
        //                   </div>
        //                 </div>
        //               @endif
        //             `;
        //   $("#inRoomUsers").append(html);
        //   }
        // }
        // if (document.getElementById('roomUser_')) {
        //   document.getElementById('isCountCard').textContent ='残り' + data.isCountCards + '枚 +' + data.isCountKillCards + '枚';
        // }
        //roomUser_{{ $key }}
      },
      error: () => {
          
      }
  });

  setTimeout("inRoomUsers()", 2000);
}