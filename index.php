<?php include_once "templates/header.php"; ?>

<div style="text-align: center">
    <h1>Site Parsing App</h1>
    <ul>
        <li><a href="parser.php">Parse the site</a></li>
        <li><a href="select_news.php">Select news</a></li>
    </ul>
</div>
<?php

$i = <<<Heredoc
A reception will be held on June 5 at 3 p.m. at the south entrance of the Beckman Institute to welcome the Illini 4000 team to the University as they bike across the United States to raise awareness of cancer and fundraise for cancer research.

The Illini 4000 team began their 2018 trip in New York City on Friday and will end in San Francisco on August 2, said Margaret Browne Huntt, associate director of the Cancer Center at Illinois, in an email.

“The Illini 4000 is a non-profit organization dedicated to documenting the American cancer experience through the Portraits Project, raising funds for cancer research and patient support services as well as spreading awareness for the fight against cancer through the fight against cancer through annual cross-country bike rides,” Huntt said.

The reception provides the public with an opportunity to meet the team and cheer them on. The event is open to anyone, including those who have been affected by cancer. It will include multiple activities such as a short program, raffle and several outdoor events, Huntt said.

Catherine Schmid, recent graduate in LAS and vice president of the Illini 4000, said the reception will be held by the Cancer Center at Illinois.

“The Cancer Center has wanted to host a reception for the Illini 4000 to welcome us back to campus. We have been currently working on a partnership with the Cancer Center and so with that, we are looking to be more involved next year with campus efforts and kind of connecting the campus community at Illinois,” Schmid said.

In years past, there have been events while the Illini 4000 cycling team has passed through campus, but this is the first year where there will be a reception hosted by the Cancer Center at Illinois.

There will be multiple people attending, possibly some who are coming from the ride along. A ride along is where people can choose to cycle from different starting or endpoints with the Illini 4000 team instead of cycling with them through the whole trip from New York City to San Francisco, Schmid said.

University Chancellor Robert Jones, Jim Moore, Jr., president and CEO of the Universtiy of Illinois Foundation and Barry Benson, vice chancellor for advancement, are participating in the ride along with the Illini 4000 team.

“This is kind of the first year we have done a ride along because the University administration has wanted to do it and we would like to have them involved as well,” Schmid said.
Heredoc;

$str = " June 5 at 3 p.m.";

$d = strpos($i, $str);

echo $d;

echo substr_replace($i,"<a href='http://google.com'>$str</a>",strlen($str),$d);

?>

<?php include_once "templates/footer.php"; ?>
