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

      let isCountCards = data.isCountCards;
      let isCountKillCards = data.isCountKillCards;
      if ( (isCountCards !== 0) && (isCountKillCards === 0) ) {
        $("#cardDeck").find(".cardDeck-visible").remove();
        var html =`
        <img class="cardDeck-visible w-50 mb-3 mt-3" src="http://xenotera.herokuapp.com/xenoCards/xenoNoCardDeck.png">
        `
        $("#cardDeck").append(html);
      } if ( (isCountCards === 0) && (isCountKillCards !== 0) ) {
        $("#cardDeck").find(".cardDeck-visible").remove();
        var html =`
        <img class="cardDeck-visible w-50 mb-3 mt-3" src="http://xenotera.herokuapp.com/xenoCards/xenoRebirthCardDeck.png">
        `
        $("#cardDeck").append(html);
      } if ( (isCountCards === 0) && (isCountKillCards === 0) ) {
        $("#cardDeck").find(".cardDeck-visible").remove();
        $("#cardDeck").append(html);
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
        // console.log(data.usedCard);
        let usedCardLatest = data.usedCard;
        for (let i = 1; i < 11; i++) {
          if (usedCardLatest == i) {
            var html =`
              <img class="usedCardLatest-visible w-38 mb-3 mt-3" src="http://xenotera.herokuapp.com/xenoCards/xenoCard_${usedCardLatest}.png">
            `
          }
        }
        if (document.getElementById('usedCard')) {
          document.getElementById('usedCard').textContent = 'フィールド：' + data.usedCard ;
        } 

      $("#usedCardLatest").append(html);
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