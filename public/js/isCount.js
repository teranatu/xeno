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
        console.log(data.usedCard);
        if (document.getElementById('isCountCard')) {
          document.getElementById('isCountCard').textContent ='残り' + data.isCountCards + '枚 +' + data.isCountKillCards + '枚';
        } if (document.getElementById('usedCard')) {
          document.getElementById('usedCard').textContent = '使用されたカード：' + data.usedCard ;
        } if (document.getElementById('inRoomUsers')) {
          document.getElementById('inRoomUsers').textContent = data.inRoomUsers + '/4人';
        }
        
      },
      error: () => {
          
      }
  });

  setTimeout("get_data()", 5000);
}