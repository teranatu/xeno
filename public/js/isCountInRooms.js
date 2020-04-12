$(function() {
  get_data();
});

function get_data() {
  $.ajax({
      url: "result/ajax/",
      dataType: "json",
      success: data => {
        // console.log(data.isCountCards);
        // console.log(data.inRoomUsers);
        // console.log(data.usedCard);
        // console.log(data.Deadcard_1);
        // console.log(data.Deadcard_2);
        // console.log(data.Deadcard_3);
        // console.log(data.Deadcard_4);
        // console.log(data.Deadcard_5);
        // console.log(data.Deadcard_6);
        // console.log(data.Deadcard_7);
        // console.log(data.Deadcard_8);
        // console.log(data.Deadcard_9);
        // console.log(data.Deadcard_10);

if (document.getElementById('inRoomUsers')) {
          document.getElementById('inRoomUsers').textContent = data.inRoomUsers + '/4人';
        } 
      },
      error: () => {
          
      }
  });

  setTimeout("get_data()", 4000);
}