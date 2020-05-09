$(function() {
  isCountCard();
  usedCard();
  deadCard();
});

function isCountCard() {
  $.ajax({
    url: "result/ajax",
    dataType: "json",
    success: data => {
      // console.log(data.isCountGroupKillCard[0]);
      // console.log(data.isCountGroupCards[0]);
      for (let i = 1,ii =1; i < 11; i++,ii+=10) {
        if ( document.getElementById(`Group${ii}`) ) {
          if (document.getElementById('isCountCard')) {
            document.getElementById('isCountCard').textContent ='残り' + data.isCountGroupCards[i-1] + '枚 +' + data.isCountGroupKillCard[i-1] + '枚';
          }
          var isCountGroupCards = data.isCountGroupCards[i-1];
          var isCountGroupKillCard = data.isCountGroupKillCard[i-1];
          if ( (isCountGroupCards !== 0) && (isCountGroupKillCard === 0) ) {
            $("#cardDeck").find(".cardDeck-visible").remove();
            var html =`
            <img class="cardDeck-visible w-100 mb-3 mt-3" src="http://xenotera.herokuapp.com/xenoCards/xenoNoCardDeck.png">
            `
            $("#cardDeck").append(html);
          } if ( (isCountGroupCards === 0) && (isCountGroupKillCard !== 0) ) {
            $("#cardDeck").find(".cardDeck-visible").remove();
            var html =`
            <img class="cardDeck-visible w-100 mb-3 mt-3" src="http://xenotera.herokuapp.com/xenoCards/xenoRebirthCardDeck.png">
            `
            $("#cardDeck").append(html);
          } if ( (isCountGroupCards !== 0) && (isCountGroupKillCard !== 0) ) {
            $("#cardDeck").find(".cardDeck-visible").remove();
            var html =`
            <img class="cardDeck-visible w-100 mb-3 mt-3" src="http://xenotera.herokuapp.com/xenoCards/xenoCardDeck.png">
            `
            $("#cardDeck").append(html);
          }
        }
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
        $("#usedCardLatest").find(".usedCardLatest-visible").remove();
        for (let i = 1,ii =1; i < 11; i++,ii+=10) {
          if ( document.getElementById(`Group${ii}`) ) {
            var html =`
              <img class="usedCardLatest-visible w-38 mb-3 mt-3" src="http://xenotera.herokuapp.com/xenoCards/xenoCard_${data.isCountGroupUsedCard[i-1]}.png">
            `
            if (document.getElementById('usedCard')) {
              document.getElementById('usedCard').textContent = 'フィールド：' + data.isCountGroupUsedCard[i-1] ;
            }
            $("#usedCardLatest").append(html);
          }
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
        for (let i = 1,ii =1; i < 11; i++,ii+=10) {
          if ( document.getElementById(`Group${ii}`) ) {
            for (let iii = 1; iii < 11; iii++) {
              let DeadCard = 'Deadcard_' + iii;
                if (document.getElementById(DeadCard)) {
                  document.getElementById(DeadCard).textContent = iii + ':' + data.isCountGroupDeadCards[i-1][iii-1] + '枚';
                } 
            }
          }
        }
      },
      error: () => {
      }
  });

  setTimeout("deadCard()", 2000);
}