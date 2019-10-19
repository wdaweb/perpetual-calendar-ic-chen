<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>萬年曆</title>
    <link rel="stylesheet" href="./fonts/google.css">
    <?php
    if(!empty($_GET['month'])) {
        $month=$_GET['month'];
    } else {
        $month=date("m");
        }

    if(!empty($_GET['year'])) {
        $year=$_GET['year'];
    } else {
        $year=date("Y");
    }
    ?>
    <?php
    $start_date=date("Y-m-d",strtotime("$year-$month-01"));
    $startDayofWeek=date("N",strtotime($start_date));
    $days_of_month=date("t",strtotime($start_date));
    $end_date=date("Y-m-d",strtotime("$year-$month-$days_of_month"));
    $endDayofWeek=date("N",strtotime($end_date));
    $weeks_of_month=ceil((($startDayofWeek-1)+$days_of_month)/7);
    $today=date("Y-m-d");
    $day=date("d");
    ?>
    <style>
        :root {
            --purple: #443742;
            --pink: #b05c7c;
            --camel: #cea07e;
            --skin: #edd9a3;
            --light: #e2e8c0;
        }
        body {
            margin: 0px;
            background-image: url(./cork-board.png);
            background-repeat: repeat;
            background-attachment: fixed;
            overflow-y: hidden;
        }
        .dot {
            height: 2vw;
            width: 2vw;
            background-color: var(--purple);
            border-radius: 50%;
            margin: auto;
            display: block;
            position: relative;
            top: 3.5vw;
        }
        .dotline {
            height: 20vw;
            width: 20vw;
            /* background: var(--purple); */
            border: 0.2vw solid var(--purple);
            transform: rotate(45deg);
            margin: auto;
            display: block;
            position: relative;
            top: 6.5vw;
            z-index: 0;
        }
        table {
            margin: auto;
            text-align: center;
            background: white;
            /* font adjust */
            color: var(--purple);
            font-size: 1.5vw;
            font-family: "Verdana", "Microsoft JhengHei";
            /* border adjust */
            border-spacing: 0;
            border-radius: 1.5em;
            border: 0.15vw solid var(--purple);
            position: relative;
            top: -12vw;
            z-index: 1;
            /* shadow */
            box-shadow: 0.4vw 0.4vw 0.8vw #333333;
        }
        table tr td {
            width: 5vw;
            height: 4.5vw;
            background: white;
            box-sizing: border-box;
            padding: 0.9vw;
        }
        table tr:nth-child(1) td {
            font-weight: bolder; 
            color: white;
            background: var(--purple);
        }
        table tr:nth-child(n+2) td:nth-child(7) {
            color: var(--light);
            background: var(--pink);
        }
        table tr:nth-child(n+2) td:nth-child(6) {
            color: var(--purple);
            background: var(--light);
        }
        /* 左上TD圓角 */
        table tr:nth-child(1) td:nth-child(1) {
            border-radius: 1.4em 0 0 0;
        }
        /* 左下TD圓角 */
        table tr:nth-child(<?=$weeks_of_month+1;?>) td:nth-child(1) {
            border-radius: 0 0 0 1.4em;
        }
        /* 右上TD圓角 */
        table tr:nth-child(1) td:nth-child(7) {
            border-radius: 0 1.4em 0 0;
        }
        /* 右下TD圓角 */
        table tr:nth-child(<?=$weeks_of_month+1;?>) td:nth-child(7) {
            border-radius: 0 0 1.4em 0;
        }
        /* 月曆日期控制 */
        .today {
            background: var(--skin) !important;
        }
        .lunardate {
            font-size: 0.5vw;
        }
        #n_holiday {
            color: var(--purple);
            background: Orange;
        }
        .title {
            text-align: center;
            color: var(--purple);
            font-size: 3vw;
            font-family: 'ZCOOL KuaiLe';
            display: inline-block;
            position: absolute;
            transform: rotate(-10deg);
            top: 13vw;
            left: 6vw;
            z-index: 1;
        }
        #note {
            width: 28vw;
            height: 26vw;
            display: inline-block;
            position: absolute;
            top: 3vw;
            left: 2vw;
            z-index: 0;
        }
        #pencil {
            width: 22vw;
            height: 40vw;
            display: block;
            position: absolute;
            top: 20vw;
            left: 73vw;
        }
    </style>
</head>
<body>
    <img id="pencil" src="pencil.png" alt="pencil" title="pencil">
    <img id="note" src="clipart.png" alt="note" title="note">
    <div class="title"><?=$year;?> 年 <?=$month;?> 月<br>
    <?php
    if (($month-1)>0) {
    ?>
    <a href="permanent_calendar.php?year=<?=$year;?>&month=<?=($month-1);?>" title="上一個月">&lt;&lt;</a>
    <?php
    } else {
    ?>
    <a href="permanent_calendar.php?year=<?=($year-1);?>&month=<?=12;?>" title="上一個月">&lt;&lt;</a>
    <?php
    }
    ?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php
    if (($month+1)>12) {
    ?>
    <a href="permanent_calendar.php?year=<?=($year+1);?>&month=<?=1;?>" title="下一個月">&gt;&gt;</a>
    <?php
    } else {
    ?>
    <a href="permanent_calendar.php?year=<?=$year;?>&month=<?=($month+1);?>" title="下一個月">&gt;&gt;</a>
    <?php
    }
    ?>
    </div>
    <div class="dot"></div>
    <div class="dotline"></div>
    <table>
        <tr>
            <td>一</td>
            <td>二</td>
            <td>三</td>
            <td>四</td>
            <td>五</td>
            <td>六</td>
            <td>日</td>
        </tr>
    <?php
    for ($i=0;$i<$weeks_of_month;$i++) {
        echo "<tr>";
        for ($j=0;$j<7;$j++) {
            $day=$i*7+$j+2-$startDayofWeek;
            $date=date("Y-m-d",mktime(0,0,0,$month,$day,$year));
                //公曆轉農曆
                require_once("lunartosolar.php");
                $lunar = new Lunar();
                $lu = $lunar->convertSolarToLunar($year, $month, $day);
                // 要印出的陰曆日期
                $ludate = str_replace("初一",$lu[1],$lu[2]);
                // 農曆轉公曆
                $solar = new Lunar();
                $solarnum = $solar->convertLunarToSolar($lu[0], $lu[4], $lu[5]);
                // 獲取陰曆12月的天數
                $lunarmonthdays = new Lunar();
                $lunDecDays = $lunarmonthdays->getLunarMonthDays($lu[0], 12);
                // 春節除夕、初一~初五
                $Dec=12;
                $issue=array(
                    1909, 1911, 1914, 1917, 1919, 1922, 1925, 1928, 1930, 1933, 1936, 1938, 1941, 1944, 1947, 1949, 1952, 1955, 1957, 1960, 1963, 1966, 1968, 1971, 1974, 1976, 1979, 1982, 1985, 1987, 1990, 1993, 1995, 1998, 2001, 2004, 2006, 2009, 2012, 2014, 2017, 2020, 2023, 2025, 2028, 2031, 2033, 2036, 2039, 2042,2044, 2047, 2050, 2052, 2055, 2058, 2061, 2063, 2066, 2069, 2071, 2073, 2076, 2079, 2081, 2084, 2087, 2089, 2092, 2095, 2097, 2100,
                );
                if (in_array($lu[0],$issue)) {
                    $Dec=$Dec+1;
                    $NewYearsEve = $solar->convertLunarToSolar($lu[0], $Dec, $lunDecDays);
                } else {
                    $Dec=$Dec;
                    $NewYearsEve = $solar->convertLunarToSolar($lu[0], $Dec, $lunDecDays);
                }
                $NewYearDayOne = $solar->convertLunarToSolar($lu[0], 1, 1);
                $NewYearDayTwo = $solar->convertLunarToSolar($lu[0], 1, 2);
                $NewYearDayThree = $solar->convertLunarToSolar($lu[0], 1, 3);
                $NewYearDayFour = $solar->convertLunarToSolar($lu[0], 1, 4);
                $NewYearDayFive = $solar->convertLunarToSolar($lu[0], 1, 5);
                // 端午節
                $DB_festival = $solar->convertLunarToSolar($lu[0], 5, 5);
                // 中秋節
                $Moon_festival = $solar->convertLunarToSolar($lu[0], 8, 15);
                $n_holiday=array(
                    mktime(0,0,0,$NewYearsEve[1],$NewYearsEve[2],$NewYearsEve[0])=>"除夕",
                    mktime(0,0,0,$NewYearDayOne[1],$NewYearDayOne[2],$NewYearDayOne[0])=>"初一",
                    mktime(0,0,0,$NewYearDayTwo[1],$NewYearDayTwo[2],$NewYearDayTwo[0])=>"初二",
                    mktime(0,0,0,$NewYearDayThree[1],$NewYearDayThree[2],$NewYearDayThree[0])=>"初三",
                    mktime(0,0,0,$NewYearDayFour[1],$NewYearDayFour[2],$NewYearDayFour[0])=>"初四",
                    mktime(0,0,0,$NewYearDayFive[1],$NewYearDayFive[2],$NewYearDayFive[0])=>"初五",
                    mktime(0,0,0,$DB_festival[1],$DB_festival[2],$DB_festival[0])=>"端午節",
                    mktime(0,0,0,$Moon_festival[1],$Moon_festival[2],$Moon_festival[0])=>"中秋節",
                    mktime(0,0,0,01,01,$year)=>"元旦",
                    mktime(0,0,0,02,28,$year)=>"228紀念日",
                    mktime(0,0,0,04,04,$year)=>"清明節",
                    mktime(0,0,0,05,01,$year)=>"勞動節",
                    mktime(0,0,0,10,10,$year)=>"國慶日",
                );
            if ($i==0) {
                if ($j<($startDayofWeek-1)) {
                    echo "<td></td>";
                } else {
                    if ($date==$today) {
                        echo "<td class='today'>".$day."<div class='lunardate'>".$ludate."</div>"."</td>";
                    }
                    else {
                        if (array_key_exists(mktime(0,0,0,$month,$day,$year),$n_holiday)) {
                            $n_holiday_name=$n_holiday[mktime(0,0,0,$month,$day,$year)];
                            echo "<td id='n_holiday'>".$day."<div class='lunardate'>".$n_holiday_name."</div>"."</td>";
                        } else {
                            echo "<td>".$day."<div class='lunardate'>".$ludate."</div>"."</td>";
                        }
                    }
                }
            } else {
                if ($day>$days_of_month) {
                    echo "<td></td>";
                } else {
                    $date=date("Y-m-d",mktime(0,0,0,$month,$day,$year));
                    if ($date==$today) {
                        echo "<td class='today'>".$day."<div class='lunardate'>".$ludate."</div>"."</td>";
                    }
                    else {
                        if (array_key_exists(mktime(0,0,0,$month,$day,$year),$n_holiday)) {
                            $n_holiday_name=$n_holiday[mktime(0,0,0,$month,$day,$year)];
                            echo "<td id='n_holiday'>".$day."<div class='lunardate'>".$n_holiday_name."</div>"."</td>";
                        } else {
                            echo "<td>".$day."<div class='lunardate'>".$ludate."</div>"."</td>";
                        }
                    }
                }
            }
        }
        echo "</tr>";
    }
    ?>
    </table>
</body>
</html>