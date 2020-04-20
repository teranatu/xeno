$(function() {
  isCountUsersInRooms();
});

function isCountUsersInRooms() {
  $.ajax({
    url: "groups/result/ajaxInRoomUsers",
    dataType: "json",
    success: data => {
      // console.log(data.isCountCards);
      // console.log(data.isCountKillCards);
      var inRoomsUsers = [
        data.inRoomUsers_1,data.inRoomUsers_2,
        data.inRoomUsers_3,data.inRoomUsers_4,
        data.inRoomUsers_5,data.inRoomUsers_6,
        data.inRoomUsers_7,data.inRoomUsers_8,
        data.inRoomUsers_9,data.inRoomUsers_10,
      ];
      for (let i = 1; i < 11; i++) {
        let inRoomUsers = 'inRoomUsers_' + i;
        let iRU = inRoomsUsers[i-1];
        if (document.getElementById(inRoomUsers)) {
          document.getElementById(inRoomUsers).textContent =iRU + '/4人';
        } 
      }
    },
    error: () => {
    }
  });
  setTimeout("isCountUsersInRooms()", 2000);
}