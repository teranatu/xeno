$(function() {
  get_data();
});

function get_data() {
  $.ajax({
      url: "result/ajax/",
      dataType: "json",
      success: data => {
        console.log(data.isCountCards);
        console.log(data.inRoomUsers);
        if (document.getElementById('isCountCard')) {
          document.getElementById('isCountCard').textContent = data.isCountCards + '枚';
        } else {
          document.getElementById('inRoomUsers').textContent = data.inRoomUsers + '/4人';
        }
        
      },
      error: () => {
          alert("ajax Error");
      }
  });

  setTimeout("get_data()", 5000);
}