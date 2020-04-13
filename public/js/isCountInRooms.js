$(function() {
  inRoomUsers();
});

function inRoomUsers() {
  $.ajax({
      url: "result/ajax/",
      dataType: "json",
      success: data => {
      if (document.getElementById('inRoomUsers')) {
        document.getElementById('inRoomUsers').textContent = data.inRoomUsers + '/4人';
      } 
      },
      error: () => {
          
      }
  });

  setTimeout("inRoomUsers()", 4000);
}