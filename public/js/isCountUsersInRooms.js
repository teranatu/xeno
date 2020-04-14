$(function() {
  isCountUsersInRooms();
});

function isCountUsersInRooms() {
  $.ajax({
    url: "result/ajax/",
    dataType: "json",
    success: data => {
      // console.log(data.isCountCards);
      // console.log(data.isCountKillCards);
      if (document.getElementById('isCountUsersInRooms')) {
        document.getElementById('isCountUsersInRooms').textContent =`${data.isCountUsersInRooms}/4人`;
      } 
    },
    error: () => {
    }
  });
  setTimeout("isCountUsersInRooms()", 2000);
}