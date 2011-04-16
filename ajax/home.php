<?php

require("../config.php");

//if ($auth->isLogged() == false) {
  echo '<h1>Envía ideas. Vota. Comenta. Participa</h1>';
  echo '		
<img style="float:right;" title="Asturix People" src="http://peop.li/wp-content/uploads/2011/04/logocollage.png" alt="Asturix People" width="256" height="256"></p>
<h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;La decisión la tomas tú</h2>
<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;que nadie decida por tí</h3>
<h3>Con Asturix People puedes:</h3>
<h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;enviar tus propias ideas,</h2>
<h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;votar ideas a favor, en contra o abstenerte</h2>
<h3>Las ideas que consigan un gran apoyo serán enviadas por email a los diputados y órganos de poder</h3>
<p style="font-size:17px;">
<p><em>El ciudadano ya no es un protagonista de la democracia, sino su acreedor pasivo</em> -&nbsp;André Bellon</p>
<p><em>Ya es <b>hora</b> de que el poder detente en las personas, el verdadero motor de la sociedad</em> -&nbsp;Ricardo López, delegado de comunicaciones del proyecto Asturix</p>
<p><em>Los políticos dicen que la democracia directa es una utopía. Con People, ya no tienen excusa </em>-&nbsp;Luis Iván Cuende, fundador y líder del proyecto Asturix</p>
<p><em>La decisión la tomas tú!</em> – Xandru Cancelas, delegado de márketing del proyecto Asturix</p>
<p><em>Un sistema perfecto para la toma de decisiones políticas, corporativas, colaborativas… Hay que ir pensando en aplicarlo a la democracia, a las empresas, a todo tipo de colaboración que requiera votaciones razonadas!</em> – Quim Moncanut, delegado de programación del proyecto Asturix</p>
<p><em>Todo el poder para la <a href="http://peop.li">peop.li!</a></em> - Marcos Menéndez, delegado de diseño del proyecto Asturix</p>
<p><em>Los cuidadanos necesitamos ser partícipes en las decisiones que nos rodean, con Asturix People esto será posible.</em> - Alberto Elías, joven emprendedor y organizador del Murcia GTUG</p>
</p>
<h1>Lanzamiento oficial de Asturix People España</h1>
<p style="font-size:16px; line-height:20px;"><img style="float:right;" src="images/republica.png" alt="80º aniversario de la 2ª república"/>En este simbólico día, <b>80º aniversario de la 2ª república</b>, todo el equipo de <a href="http://asturix.com">Asturix</a> estamos orgullosos de anunciar el lanzamiento de la primera comunidad que hará uso de nuestro nuevo y revolucionario software de <b>democracia directa</b>, Asturix People.<br /><br />El funcionamiento de <b>Asturix People España</b> será simple: las ideas más votadas <b>serán enviadas al gobierno y partidos políticos</b>, con el fin de presionarles para que lleven a la práctica lo que el pueblo español les pide.<br />Puedes registrarte ahora mismo y comenzar a <b>enviar tus propias ideas</b>, <b>votar</b> las existentes o comentarlas.

<h1>Movimientos pro-democracia</h1>

<iframe title="YouTube video player" width="45%" height="300" src="http://www.youtube.com/embed/1SAfFFpGF3E" frameborder="0" allowfullscreen></iframe>
<iframe style="float:right;" title="YouTube video player" width="45%" height="300" src="http://www.youtube.com/embed/vRSyAd8vI6A" frameborder="0" allowfullscreen></iframe>
';
  /*return false;
}*/

/*$page=1;

echo '<h1>'. _('Hot ideas') .'</h1>';

$ideas = $db->getHotIdeas($page);

while ($idea = $ideas->fetch_array(MYSQLI_ASSOC)) 
{
$ui->idea($idea, true);
}

$ideasNum = $db->getNumberOfHotIdeas();
$pages = ceil($ideasNum/ITEMS);

echo '<div class="pagination">';

for ($i=1; $i<=$pages; $i++)
{
echo '<button onclick="viewHotIdeas('.$i.')"';
if ($i == $page) {
echo 'class="currentPage"';
}
echo '>'.$i.'</button>';
}

echo '</div>';*/


?>