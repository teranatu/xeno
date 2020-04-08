$(function() {
  get_data();
});

function get_data() {
  $.ajax({
      url: "result/ajax/",
      dataType: "json",
      success: data => {
        console.log(data.Deadcard_1);
        console.log(data.Deadcard_2);
        console.log(data.Deadcard_3);
        console.log(data.Deadcard_4);
        console.log(data.Deadcard_5);
        console.log(data.Deadcard_6);
        console.log(data.Deadcard_7);
        console.log(data.Deadcard_8);
        console.log(data.Deadcard_9);
        console.log(data.Deadcard_10);

        if (document.getElementById('Deadcard_1')) {
          document.getElementById('Deadcard_1').textContent = '1:' + data.Deadcard_1 + '枚';
        } if (document.getElementById('Deadcard_2')) {
          document.getElementById('Deadcard_2').textContent = '2:' + data.Deadcard_2 + '枚';
        } if (document.getElementById('Deadcard_3')) {
          document.getElementById('Deadcard_3').textContent = '3:' + data.Deadcard_3 + '枚';
        } if (document.getElementById('Deadcard_4')) {
          document.getElementById('Deadcard_4').textContent = '4:' + data.Deadcard_4 + '枚';
        } if (document.getElementById('Deadcard_5')) {
          document.getElementById('Deadcard_5').textContent = '5:' + data.Deadcard_5 + '枚';
        } if (document.getElementById('Deadcard_6')) {
          document.getElementById('Deadcard_6').textContent = '6:' + data.Deadcard_6 + '枚';
        } 
        
      },
      error: () => {
          
      }
  });

  setTimeout("get_data()", 2000);
}