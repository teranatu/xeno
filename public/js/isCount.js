$(function() {
  isCountCard();
  usedCard();
  deadCard();
});

function isCountCard() {
  $.ajax({
    url: "result/ajax/",
    dataType: "json",
    success: data => {
      // console.log(data.isCountCards);
      // console.log(data.isCountKillCards);
      if (document.getElementById('isCountCard')) {
        document.getElementById('isCountCard').textContent ='残り' + data.isCountCards + '枚 +' + data.isCountKillCards + '枚';
      } 
    },
    error: () => {
    }
  });
  setTimeout("isCountCard()", 2000);
}

function usedCard() {
  $.ajax({
      url: "result/ajax/",
      dataType: "json",
      success: data => {
        // console.log(data.usedCard);
        if (document.getElementById('usedCard')) {
          document.getElementById('usedCard').textContent = 'フィールド：' + data.usedCard ;
        } 
      },
      error: () => {
      }
  });
  setTimeout("usedCard()", 2000);
}

function deadCard() {
  $.ajax({
      url: "result/ajax/",
      dataType: "json",
      success: data => {
        var dDC = [
          data.Deadcard_1,data.Deadcard_2,
          data.Deadcard_3,data.Deadcard_4,
          data.Deadcard_5,data.Deadcard_6,
          data.Deadcard_7,data.Deadcard_8,
          data.Deadcard_9,data.Deadcard_10,
        ]
        for (let index = 1; index < 11; index++) {
          let DeadCard = 'Deadcard_' + index;
          let ddc = dDC[index-1];
          if (document.getElementById(DeadCard)) {
            document.getElementById(DeadCard).textContent = index + ':' + ddc + '枚';
          } 
        }
      },
      error: () => {
      }
  });

  setTimeout("deadCard()", 2000);
}