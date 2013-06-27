<html>
  <head>
    <title>Flipper&aring;rsbok</title>
  </head>
  <body bgcolor="#000000" text="#000000">
    <div style="width:755px;height:566px;margin:100px;padding:20px;background-image: url(../images/misc/flipperarsbok-background.jpg);">
      <h1>Grattis!</h1>
Du har precis best&auml;llt en bok som av framtida forskare kommer att n&auml;mnas i samma andetag som "Skattkammar&ouml;n", "Det bl&aring;ser på m&aring;nen" och "Chrusjtjov minns". Men &auml;n &auml;r den inte din. Vi &auml;r n&auml;mligen s&aring; fr&auml;cka att vi vill ha betalt ocks&aring;.<br><br>
Du har best&auml;llt <?php echo $_GET['antal'];?> b&ouml;cker f&ouml;r sammanlagt <b><?php echo $_GET['antal']*189?></b> kr (eller <?php echo $_GET['antal']*89?> kr om du bidragit/bidrar till boken). Du kan välja mellan att betala via bank, till ett bankgiro, med PayPal eller med kreditkort.<br><br>
För betalning via bank, sätt in pengarna på SEB 5012-0018861 (kontoinnehavare Hans Andersson).<br><b>Glöm inte att ange din TAG!</b><br><br>
För betalning till BG, sätt in pengarna på 5909-5182 (Stockholm Open / Patrik Bodin).<br><b>Glöm inte att ange din TAG!</b><br><br>
För betalning via PayPal, skicka pengarna till the@pal.pp.se, eller klicka på knappen nedan.<br><b>Glöm inte att ange din TAG!</b><br><br>
För betalning med kreditkort, klicka på knappen nedan.<br><b>Glöm inte att ange din TAG!</b><br><br>
      <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="266701">
        <input type="hidden" name="page_style" value="StockholmOpen" />
        <?php echo '<input type="hidden" name="quantity" value="' . $_GET["antal"] . '">';?>
        <table>
          <tr><td>
            <input type="hidden" name="on0" value="Priset">
          </td></tr>
          <tr><td>
            <select name="os0">
	      <option value="Fullt pris">Fullt pris: <?php echo $_GET['antal']*189?> kr
	      <option value="Bidragspris">Bidragspris: <?php echo $_GET['antal']*89?> kr
            </select>
          </td></tr>
        </table>
        <input type="hidden" name="currency_code" value="SEK">
        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_buynowCC_LG_global.gif" border="0" name="submit" alt="">
        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
      </form>
      <i>Om antalet &auml;r fel s&aring; kan du &auml;ndra det p&aring; betalningssidan.</i><br>
      <i><b>Sista betalningsdag är 2008-10-31!</b></i> 
    </div>
  </body>
</html>
