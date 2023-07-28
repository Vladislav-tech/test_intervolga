<?php

declare(strict_types=1);

$text = <<<TXT
<p class="big">
  Год основания:<b>1589 г.</b> Волгоград отмечает день города в <b>2-е воскресенье сентября</b>. 
В <b>2023 году</b> эта дата - <b>10 сентября</b>.
</p>
<p class="float">
  <img src="https://www.calend.ru/img/content_events/i0/961.jpg" alt="Волгоград" width="300" height="200" itemprop="image">
  <span class="caption gray">Скульптура «Родина-мать зовет!» входит в число семи чудес России (Фото: Art Konovalov, по лицензии shutterstock.com)</span>
</p>
<p>
  <i><b>Великая Отечественная война в истории города</b></i></p><p><i>Важнейшей операцией Советской Армии в Великой Отечественной войне стала <a href="https://www.calend.ru/holidays/0/0/1869/">Сталинградская битва</a> (17.07.1942 - 02.02.1943). Целью боевых действий советских войск являлись оборона  Сталинграда и разгром действовавшей на сталинградском направлении группировки противника. Победа советских войск в Сталинградской битве имела решающее значение для победы Советского Союза в Великой Отечественной войне.</i>
</p>
TXT;


function cutString(string $str): string
{
    $strWithoutTags = strip_tags($str);

    $words = array_slice(explode(" ", $strWithoutTags), 0 , 29);

    return implode(" ", $words) . "...";
}

echo cutString($text);