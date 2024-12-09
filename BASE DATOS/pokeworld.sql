-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2024 a las 01:59:33
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pokeworld`
--
CREATE DATABASE pokeworld;

USE pokeworld;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `idComentario` int(100) NOT NULL,
  `contenidoComentario` varchar(500) NOT NULL,
  `puntuacion` int(10) NOT NULL,
  `FK_usuario` int(100) NOT NULL,
  `FK_hilo` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`idComentario`, `contenidoComentario`, `puntuacion`, `FK_usuario`, `FK_hilo`) VALUES
(491, 'EYY!! you can give us new ideas to create new themes', 3, 2, 62),
(493, 'Let´s talk about great pokemon´s habilities!!', 1, 2, 64),
(494, 'I would like a theme only about bulbasaur!!', 0, 8, 62),
(496, 'Well the greatest hability is cold storm', 2, 8, 64),
(497, 'I want one theme about pokemon´s videogames', 2, 9, 62),
(498, 'Well.. the coolest pokemon is Rankiu', 0, 9, 63),
(499, 'And ivysaur!!!!', 3, 9, 63),
(500, 'Since my point of view a great hability is dark sun...', 1, 9, 64),
(502, 'plsss a theme about the ugliest pokemonssss', 1, 10, 62),
(503, 'People from here don´t know about pokemons. The best pokemon is pikachu!!!', 0, 10, 63),
(504, 'mmmm.. the best hability could be electric one', 0, 10, 64),
(505, 'and another theme about the most expensive pokemons', 0, 9, 62),
(506, 'Hi guys!! you can talk here about the worst pokemon habilities!', 1, 2, 66),
(507, 'Ey guys you can talk about here the best poke gyms. Have fun!!', 0, 2, 67);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frasespokemon`
--

CREATE TABLE `frasespokemon` (
  `idFrase` int(100) NOT NULL,
  `contenidoFrase` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `FK_pokemon` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `frasespokemon`
--

INSERT INTO `frasespokemon` (`idFrase`, `contenidoFrase`, `FK_pokemon`) VALUES
(752, 'A strange seed wasplanted on itsback at birth.The plant sproutsand grows withthis POKMON.', 483),
(753, 'It can go for dayswithout eating asingle morsel.In the bulb onits back, itstores energy.', 483),
(754, 'When the bulb onits back growslarge, it appearsto lose theability to standon its hind legs.', 484),
(755, 'The bulb on itsback grows bydrawing energy.It gives off anaroma when it isready to bloom.', 484),
(756, 'The plant bloomswhen it isabsorbing solarenergy. It stayson the move toseek sunlight.', 485),
(757, 'The flower on itsback catches thesuns rays.The sunlight isthen absorbed andused for energy.', 485),
(758, 'Obviously prefershot places. Whenit rains, steamis said to spoutfrom the tip ofits tail.', 486),
(759, 'The flame at thetip of its tailmakes a sound asit burns. You canonly hear it inquiet places.', 486),
(760, 'When it swingsits burning tail,it elevates thetemperature tounbearably highlevels.', 487),
(761, 'Tough fights couldexcite thisPOKMON. Whenexcited, it mayblow out bluishwhite flames.', 487),
(762, 'Spits fire thatis hot enough tomelt boulders.Known to causeforest firesunintentionally.', 488),
(763, 'When expelling ablast of superhot fire, the redflame at the tipof its tail burnsmore intensely.', 488),
(764, 'After birth, itsback swells andhardens into ashell. Powerfullysprays foam fromits mouth.', 489),
(765, 'Shoots water atprey while in thewater.Withdraws intoits shell when indanger.', 489),
(766, 'Often hides inwater to stalkunwary prey. Forswimming fast, itmoves its ears tomaintain balance.', 490),
(767, 'When tapped, thisPOKMON will pullin its head, butits tail willstill stick out alittle bit.', 490),
(768, 'A brutal POKMONwith pressurizedwater jets on itsshell. They areused for highspeed tackles.', 491),
(769, 'Once it takes aimat its enemy, itblasts out waterwith even moreforce than a firehose.', 491),
(770, 'Its short feet are tipped with suctionpads that enable it to tirelessly climbslopes and walls.', 492),
(771, 'Its short feetare tipped withsuction pads thatenable it totirelessly climbslopes and walls.', 492),
(772, 'This POKMON isvulnerable toattack while itsshell is soft,exposing its weakand tender body.', 493),
(773, 'Hardens its shellto protect itself.However, a largeimpact may causeit to pop out ofits shell.', 493),
(774, 'In battle, itflaps its wingsat high speed torelease highlytoxic dust intothe air.', 494),
(775, 'Its wings, coveredwith poisonouspowders, repelwater. Thisallows it to flyin the rain.', 494),
(776, 'Often found inforests, eatingleaves.It has a sharpvenomous stingeron its head.', 495),
(777, 'Beware of thesharp stinger onits head. Ithides in grassand bushes whereit eats leaves.', 495),
(778, 'Almost incapableof moving, thisPOKMON can onlyharden its shellto protect itselffrom predators.', 496),
(779, 'Able to move onlyslightly. Whenendangered, itmay stick out itsstinger and poisonits enemy.', 496),
(780, 'It has three poisonous stingers on its forelegs andits tail. They are used to jab its enemy repeated', 497),
(781, 'Flies at highspeed and attacksusing its largevenomous stingerson its forelegsand tail.', 497),
(782, 'A common sight inforests and woods.It flaps itswings at groundlevel to kick upblinding sand.', 498),
(783, 'Very docile. Ifattacked, it willoften kick upsand to protectitself ratherthan fight back.', 498),
(784, 'Very protectiveof its sprawlingterritorial area,this POKMON willfiercely peck atany intruder.', 499),
(785, 'This POKMON isfull of vitality.It constantlyflies around itslarge territory insearch of prey.', 499),
(786, 'When hunting, itskims the surfaceof water at highspeed to pick offunwary prey suchas MAGIKARP.', 500),
(787, 'This POKMON fliesat Mach  speed,seeking prey.Its large talonsare feared aswicked weapons.', 500),
(788, 'Bites anythingwhen it attacks.Small and veryquick, it is acommon sight inmany places.', 501),
(789, 'Will chew on anything with itsfangs. If you seeone, it is certainthat  more livein the area.', 501),
(790, 'It uses its whiskers to maintainits balance.It apparentlyslows down ifthey are cut off.', 502),
(791, 'Its hind feet arewebbed. They actas flippers, soit can swim inrivers and huntfor prey.', 502),
(792, 'It flaps its small wings busily tofly. Using its beak, it searchesin grass for prey.', 503),
(793, 'Eats bugs ingrassy areas. Ithas to flap itsshort wings athigh speed tostay airborne.', 503),
(794, 'With its huge andmagnificent wings,it can keep aloftwithout everhaving to landfor rest.', 504),
(795, 'A POKMON thatdates back manyyears. If itsenses danger, itflies high andaway, instantly.', 504),
(796, 'Moves silentlyand stealthily.Eats the eggs ofbirds, such asPIDGEY andSPEAROW, whole.', 505),
(797, 'The older it gets,the longer itgrows. At night,it wraps its longbody around treebranches to rest.', 505),
(798, 'It is rumored thatthe ferociouswarning markingson its bellydiffer from areato area.', 506),
(799, 'The frighteningpatterns on itsbelly have beenstudied. Sixvariations havebeen confirmed.', 506),
(800, 'When several ofthese POKMONgather, theirelectricity couldbuild and causelightning storms.', 507),
(801, 'It keeps its tailraised to monitorits surroundings.If you yank itstail, it will tryto bite you.', 507),
(802, 'Its long tail serves as a ground to protect itselffrom its own highvoltage power.', 508),
(803, 'Its long tailserves as aground to protectitself from itsown high voltagepower.', 508),
(804, 'Burrows deepunderground inarid locationsfar from water.It only emergesto hunt for food.', 509),
(805, 'Its body is dry.When it gets coldat night, itshide is said tobecome coated witha fine dew.', 509),
(806, 'Curls up into aspiny ball whenthreatened. Itcan roll whilecurled up toattack or escape.', 510),
(807, 'It is skilled atslashing enemieswith its claws.If broken, theystart to grow backin a day.', 510),
(808, 'Although small,its venomousbarbs render thisPOKMON dangerous.The female hassmaller horns.', 511),
(809, 'A mildmanneredPOKMON that doesnot like tofight. Beware, itssmall hornssecrete venom.', 511),
(810, 'The females horndevelops slowly.Prefers physicalattacks such asclawing andbiting.', 512),
(811, 'When resting deepin its burrow, itsthorns alwaysretract.This is proof thatit is relaxed.', 512),
(812, 'Its hard scalesprovide strongprotection. Ituses its heftybulk to executepowerful moves.', 513),
(813, 'Tough scales coverthe sturdy bodyof this POKMON.It appears thatthe scales growin cycles.', 513),
(814, 'Stiffens its earsto sense danger.The larger itshorns, the morepowerful itssecreted venom.', 514),
(815, 'Its large earsare always keptupright. If itsenses danger, itwill attack with apoisonous sting.', 514),
(816, 'An aggressivePOKMON that isquick to attack.The horn on itshead secretes apowerful venom.', 515),
(817, 'Its horns containvenom. If theyare stabbed intoan enemy, theimpact makes thepoison leak out.', 515),
(818, 'It uses itspowerful tail inbattle to smash,constrict, thenbreak the preysbones.', 516),
(819, 'Its steellikehide adds to itspowerful tackle.Its horns are sohard, they canpierce a diamond.', 516),
(820, 'Its magical andcute appeal hasmany admirers.It is rare andfound only incertain areas.', 517),
(821, 'Adored for theircute looks andplayfulness. Theyare thought to berare, as they donot appear often.', 517),
(822, 'A timid fairyPOKMON that israrely seen. Itwill run and hidethe moment itsenses people.', 518),
(823, 'They appear to bevery protective oftheir own world.It is a kind offairy, rarely seenby people.', 518),
(824, 'At the time ofbirth, it hasjust one tail.The tail splitsfrom its tip asit grows older.', 519),
(825, 'Both its fur andits tails arebeautiful. As itgrows, the tailssplit and formmore tails.', 519),
(826, 'Very smart andvery vengeful.Grabbing one ofits many tailscould result in ayear curse.', 520),
(827, 'According to anenduring legend, noble saintswere united andreincarnated asthis POKMON.', 520),
(828, 'When its huge eyeslight up, it singsa mysteriouslysoothing melodythat lulls itsenemies to sleep.', 521),
(829, 'Uses its alluringeyes to enraptureits foe. It thensings a pleasingmelody that lullsthe foe to sleep.', 521),
(830, 'The body is softand rubbery. Whenangered, it willsuck in air andinflate itself toan enormous size.', 522),
(831, 'Its body is fullof elasticity. Byinhaling deeply,it can continueto inflate itselfwithout limit.', 522),
(832, 'Forms colonies inperpetually darkplaces. Usesultrasonic wavesto identify andapproach targets.', 523),
(833, 'Emits ultrasoniccries while itflies. They actas a sonar usedto check for objects in its way.', 523),
(834, 'Once it strikes,it will not stopdraining energyfrom the victimeven if it getstoo heavy to fly.', 524),
(835, 'It attacks in astealthy manner,without warning.Its sharp fangsare used to biteand suck blood.', 524),
(836, 'During the day,it keeps its faceburied in theground. At night,it wanders aroundsowing its seeds.', 525),
(837, 'It may be mistakenfor a clump ofweeds. If you tryto yank it out ofthe ground, itshrieks horribly.', 525),
(838, 'The fluid thatoozes from itsmouth isnt drool.It is a nectarthat is used toattract prey.', 526),
(839, 'Smells incrediblyfoul However,around  out of, people enjoysniffing its nosebending stink.', 526),
(840, 'It has the worlds largest petals. With every step,the petals shake out heavy clouds of toxic pollen.', 527),
(841, 'The larger itspetals, the moretoxic pollen itcontains. Its bighead is heavy andhard to hold up.', 527),
(842, 'Burrows to sucktree roots. Themushrooms on itsback grow by drawing nutrients fromthe bug host.', 528),
(843, 'Burrows under theground to gnaw ontree roots. Themushrooms on itsback absorb mostof the nutrition.', 528),
(844, 'A hostparasitepair in which theparasite mushroomhas taken over thehost bug. Prefersdamp places.', 529),
(845, 'The bug host isdrained of energyby the mushroomson its back. Theyappear to do allthe thinking.', 529),
(846, 'Lives in theshadows of talltrees where iteats insects. Itis attracted bylight at night.', 530),
(847, 'Its large eyes actas radars. In abright place, youcan see that theyare clusters ofmany tiny eyes.', 530),
(848, 'The dustlike scales covering its wingsare colorcoded to indicate the kinds ofpoison it has.', 531),
(849, 'The dustlikescales coveringits wings arecolor coded toindicate the kindsof poison it has.', 531),
(850, 'Lives about oneyard undergroundwhere it feeds onplant roots. Itsometimes appearsabove ground.', 532),
(851, 'It prefers darkplaces. It spendsmost of its timeunderground,though it may popup in caves.', 532),
(852, 'A team of DIGLETTtriplets.It triggers hugeearthquakes byburrowing  milesunderground.', 533),
(853, 'A team of tripletsthat can burrowover  MPH.Due to this, somepeople think itsan earthquake.', 533),
(854, 'It washes its face regularly to keep the coin onits forehead spotless. It doesnt get along withGalar', 534),
(855, 'Adores circularobjects. Wandersthe streets on anightly basis tolook for droppedloose change.', 534),
(856, 'Although its furhas many admirers,it is tough toraise as a petbecause of itsfickle meanness.', 535),
(857, 'The gem in itsforehead glows onits own It walkswith all the graceand elegance of aproud queen.', 535),
(858, 'While lulling itsenemies with itsvacant look, thiswily POKMON willuse psychokineticpowers.', 536),
(859, 'Always tormentedby headaches.It uses psychicpowers, but it isnot known if itintends to do so.', 536),
(860, 'Often seen swimming elegantly bylake shores. Itis often mistakenfor the Japanesemonster, Kappa.', 537),
(861, 'Its slim and longlimbs end in broadflippers. Theyare used for swimming gracefullyin lakes.', 537),
(862, 'Extremely quick toanger. It couldbe docile onemoment thenthrashing awaythe next instant.', 538),
(863, 'An agile POKMONthat lives intrees. It angerseasily and willnot hesitate toattack anything.', 538),
(864, 'Always furiousand tenacious toboot. It will notabandon chasingits quarry untilit is caught.', 539),
(865, 'It stops beingangry only whennobody else isaround. To viewthis moment isvery difficult.', 539),
(866, 'Very protectiveof its territory.It will bark andbite to repelintruders fromits space.', 540),
(867, 'A POKMON with afriendly nature.However, it willbark fiercely atanything invadingits territory.', 540),
(868, 'A POKMON thathas been admiredsince the pastfor its beauty.It runs agilelyas if on wings.', 541),
(869, 'A legendary POKMON in China.Many people arecharmed by itsgrace and beautywhile running.', 541),
(870, 'Its newly grownlegs prevent itfrom running. Itappears to preferswimming thantrying to stand.', 542),
(871, 'The direction ofthe spiral on thebelly differs byarea. It is moreadept at swimmingthan walking.', 542),
(872, 'Capable of livingin or out ofwater. When outof water, itsweats to keepits body slimy.', 543),
(873, 'Under attack, ituses its belly spiral to put thefoe to sleep. Itthen makes itsescape.', 543),
(874, 'An adept swimmerat both the frontcrawl and breaststroke. Easilyovertakes the besthuman swimmers.', 544),
(875, 'Swims powerfullyusing all themuscles in itsbody. It can evenovertake championswimmers.', 544),
(876, 'Using its abilityto read minds, itwill identifyimpending dangerand TELEPORT tosafety.', 545),
(877, 'Sleeps  hours aday. If it sensesdanger, it willteleport itself tosafety even as itsleeps.', 545),
(878, 'It emits specialalpha waves fromits body thatinduce headachesjust by beingclose by.', 546),
(879, 'Many odd thingshappen if thisPOKMON is closeby. For example,it makes clocksrun backwards.', 546),
(880, 'Its brain can outperform a supercomputer.Its intelligencequotient is saidto be ,.', 547),
(881, 'A POKMON that canmemorize anything.It never forgetswhat it learnsthats why thisPOKMON is smart.', 547),
(882, 'Loves to buildits muscles.It trains in allstyles of martialarts to becomeeven stronger.', 548),
(883, 'Very powerful inspite of its smallsize. Its masteryof many types ofmartial arts makesit very tough.', 548),
(884, 'Its muscular bodyis so powerful, itmust wear a powersave belt to beable to regulateits motions.', 549),
(885, 'The belt aroundits waist holdsback its energy.Without it, thisPOKMON would beunstoppable.', 549),
(886, 'Using its heavymuscles, it throwspowerful punchesthat can send thevictim clear overthe horizon.', 550),
(887, 'One arm alone canmove mountains.Using all fourarms, this POKMONfires off awesomepunches.', 550),
(888, 'A carnivorousPOKMON that trapsand eats bugs.It uses its rootfeet to soak upneeded moisture.', 551),
(889, 'Prefers hot andhumid places.It ensnares tinyinsects with itsvines and devoursthem.', 551),
(890, 'It spits outPOISONPOWDER toimmobilize theenemy and thenfinishes it witha spray of ACID.', 552),
(891, 'When hungry, itswallows anythingthat moves. Itshapless prey ismelted inside bystrong acids.', 552),
(892, 'Said to live inhuge coloniesdeep in jungles,although no onehas ever returnedfrom there.', 553),
(893, 'Lures prey withthe sweet aroma ofhoney. Swallowedwhole, the prey ismelted in a day,bones and all.', 553),
(894, 'Drifts in shallowseas. Anglers whohook them byaccident areoften punished byits stinging acid.', 554),
(895, 'It can sometimesbe found all dryand shriveled upon a beach. Tossit back into thesea to revive it.', 554),
(896, 'The tentacles arenormally keptshort. On hunts,they are extendedto ensnare andimmobilize prey.', 555),
(897, 'Its  tentaclescan stretch andcontract freely.They wrap aroundprey and weakenit with poison.', 555),
(898, 'Found in fieldsand mountains.Mistaking themfor boulders,people often stepor trip on them.', 556),
(899, 'Commonly foundnear mountaintrails, etc.If you step onone by accident,it gets angry.', 556),
(900, 'Rolls down slopesto move. It rollsover any obstaclewithout slowingor changing itsdirection.', 557),
(901, 'Often seen rollingdown mountaintrails. Obstaclesare just things toroll straightover, not avoid.', 557),
(902, 'Its boulderlikebody is extremelyhard. It caneasily withstanddynamite blastswithout damage.', 558),
(903, 'Once it sheds itsskin, its bodyturns tender andwhitish. Its hidehardens when itsexposed to air.', 558),
(904, 'Its hooves are times harder thandiamonds. It cantrample anythingcompletely flatin little time.', 559),
(905, 'Capable of jumpingincredibly high.Its hooves andsturdy legs absorbthe impact of ahard landing.', 559),
(906, 'Very competitive,this POKMON willchase anythingthat moves fastin the hopes ofracing it.', 560),
(907, 'Just loves to run.If it sees something faster thanitself, it willgive chase at topspeed.', 560),
(908, 'Incredibly slowand dopey. Ittakes  secondsfor it to feelpain when underattack.', 561),
(909, 'Incredibly slowand sluggish. Itis quite contentto loll aboutwithout worryingabout the time.', 561),
(910, 'The SHELLDER thatis latched ontoSLOWPOKEs tailis said to feedon the hosts leftover scraps.', 562),
(911, 'Lives lazily bythe sea. If theSHELLDER on itstail comes off,it becomes aSLOWPOKE again.', 562),
(912, 'Uses antigravityto stay suspended.Appears withoutwarning and usesTHUNDER WAVE andsimilar moves.', 563),
(913, 'It is born withthe ability todefy gravity. Itfloats in air onpowerful electromagnetic waves.', 563),
(914, 'Formed by severalMAGNEMITEs linkedtogether. Theyfrequently appearwhen sunspotsflare up.', 564),
(915, 'Generates strangeradio signals. Itraises the temperature by .Fdegrees within, feet.', 564),
(916, 'The sprig ofgreen onions itholds is itsweapon. It isused much like ametal sword.', 565),
(917, 'Lives where reedyplants grow. Theyare rarely seen,so its thoughttheir numbers aredecreasing.', 565),
(918, 'A bird that makesup for its poorflying with itsfast foot speed.Leaves giantfootprints.', 566),
(919, 'Its short wingsmake flying difficult. Instead,this POKMON runsat high speed ondeveloped legs.', 566),
(920, 'Uses its threebrains to executecomplex plans.While two headssleep, one headstays awake.', 567),
(921, 'One of DODUOs heads splits toform a uniquespecies. It runsclose to  MPHin prairies.', 567),
(922, 'The protrudinghorn on its headis very hard.It is used forbashing throughthick ice.', 568),
(923, 'Loves freezingcold conditions.Relishes swimmingin a frigid climate of around Fdegrees.', 568);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habilidad`
--

CREATE TABLE `habilidad` (
  `idHabilidad` int(100) NOT NULL,
  `nombreHabilidad` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habilidad`
--

INSERT INTO `habilidad` (`idHabilidad`, `nombreHabilidad`) VALUES
(3512, 'stench'),
(3513, 'drizzle'),
(3514, 'speed-boost'),
(3515, 'battle-armor'),
(3516, 'sturdy'),
(3517, 'damp'),
(3518, 'limber'),
(3519, 'sand-veil'),
(3520, 'static'),
(3521, 'volt-absorb'),
(3522, 'water-absorb'),
(3523, 'oblivious'),
(3524, 'cloud-nine'),
(3525, 'compound-eyes'),
(3526, 'insomnia'),
(3527, 'color-change'),
(3528, 'immunity'),
(3529, 'flash-fire'),
(3530, 'shield-dust'),
(3531, 'own-tempo'),
(3532, 'suction-cups'),
(3533, 'intimidate'),
(3534, 'shadow-tag'),
(3535, 'rough-skin'),
(3536, 'wonder-guard'),
(3537, 'levitate'),
(3538, 'effect-spore'),
(3539, 'synchronize'),
(3540, 'clear-body'),
(3541, 'natural-cure'),
(3542, 'lightning-rod'),
(3543, 'serene-grace'),
(3544, 'swift-swim'),
(3545, 'chlorophyll'),
(3546, 'illuminate'),
(3547, 'trace'),
(3548, 'huge-power'),
(3549, 'poison-point'),
(3550, 'inner-focus'),
(3551, 'magma-armor'),
(3552, 'water-veil'),
(3553, 'magnet-pull'),
(3554, 'soundproof'),
(3555, 'rain-dish'),
(3556, 'sand-stream'),
(3557, 'pressure'),
(3558, 'thick-fat'),
(3559, 'early-bird'),
(3560, 'flame-body'),
(3561, 'run-away'),
(3562, 'keen-eye'),
(3563, 'hyper-cutter'),
(3564, 'pickup'),
(3565, 'truant'),
(3566, 'hustle'),
(3567, 'cute-charm'),
(3568, 'plus'),
(3569, 'minus'),
(3570, 'forecast'),
(3571, 'sticky-hold'),
(3572, 'shed-skin'),
(3573, 'guts'),
(3574, 'marvel-scale'),
(3575, 'liquid-ooze'),
(3576, 'overgrow'),
(3577, 'blaze'),
(3578, 'torrent'),
(3579, 'swarm'),
(3580, 'rock-head'),
(3581, 'drought'),
(3582, 'arena-trap'),
(3583, 'vital-spirit'),
(3584, 'white-smoke'),
(3585, 'pure-power'),
(3586, 'shell-armor'),
(3587, 'air-lock'),
(3588, 'tangled-feet'),
(3589, 'motor-drive'),
(3590, 'rivalry'),
(3591, 'steadfast'),
(3592, 'snow-cloak'),
(3593, 'gluttony'),
(3594, 'anger-point'),
(3595, 'unburden'),
(3596, 'heatproof'),
(3597, 'simple'),
(3598, 'dry-skin'),
(3599, 'download'),
(3600, 'iron-fist'),
(3601, 'poison-heal'),
(3602, 'adaptability'),
(3603, 'skill-link'),
(3604, 'hydration'),
(3605, 'solar-power'),
(3606, 'quick-feet'),
(3607, 'normalize'),
(3608, 'sniper'),
(3609, 'magic-guard'),
(3610, 'no-guard'),
(3611, 'stall'),
(3612, 'technician'),
(3613, 'leaf-guard'),
(3614, 'klutz'),
(3615, 'mold-breaker'),
(3616, 'super-luck'),
(3617, 'aftermath'),
(3618, 'anticipation'),
(3619, 'forewarn'),
(3620, 'unaware'),
(3621, 'tinted-lens'),
(3622, 'filter'),
(3623, 'slow-start'),
(3624, 'scrappy'),
(3625, 'storm-drain'),
(3626, 'ice-body'),
(3627, 'solid-rock'),
(3628, 'snow-warning'),
(3629, 'honey-gather'),
(3630, 'frisk'),
(3631, 'reckless'),
(3632, 'multitype'),
(3633, 'flower-gift'),
(3634, 'bad-dreams'),
(3635, 'pickpocket'),
(3636, 'sheer-force'),
(3637, 'contrary'),
(3638, 'unnerve'),
(3639, 'defiant'),
(3640, 'defeatist'),
(3641, 'cursed-body'),
(3642, 'healer'),
(3643, 'friend-guard'),
(3644, 'weak-armor'),
(3645, 'heavy-metal'),
(3646, 'light-metal'),
(3647, 'multiscale'),
(3648, 'toxic-boost'),
(3649, 'flare-boost'),
(3650, 'harvest'),
(3651, 'telepathy'),
(3652, 'moody'),
(3653, 'overcoat'),
(3654, 'poison-touch'),
(3655, 'regenerator'),
(3656, 'big-pecks'),
(3657, 'sand-rush'),
(3658, 'wonder-skin'),
(3659, 'analytic'),
(3660, 'illusion'),
(3661, 'imposter'),
(3662, 'infiltrator'),
(3663, 'mummy'),
(3664, 'moxie'),
(3665, 'justified'),
(3666, 'rattled'),
(3667, 'magic-bounce'),
(3668, 'sap-sipper'),
(3669, 'prankster'),
(3670, 'sand-force'),
(3671, 'iron-barbs'),
(3672, 'zen-mode'),
(3673, 'victory-star'),
(3674, 'turboblaze'),
(3675, 'teravolt'),
(3676, 'aroma-veil'),
(3677, 'flower-veil'),
(3678, 'cheek-pouch'),
(3679, 'protean'),
(3680, 'fur-coat'),
(3681, 'magician'),
(3682, 'bulletproof'),
(3683, 'competitive'),
(3684, 'strong-jaw'),
(3685, 'refrigerate'),
(3686, 'sweet-veil'),
(3687, 'stance-change'),
(3688, 'gale-wings');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitat`
--

CREATE TABLE `habitat` (
  `idHabitat` int(100) NOT NULL,
  `nombreHabitat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitat`
--

INSERT INTO `habitat` (`idHabitat`, `nombreHabitat`) VALUES
(350, 'cave'),
(351, 'forest'),
(352, 'grassland'),
(353, 'mountain'),
(354, 'rare'),
(355, 'rough-terrain'),
(356, 'sea'),
(357, 'urban'),
(358, 'waters-edge');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hilosforo`
--

CREATE TABLE `hilosforo` (
  `idHilo` int(100) NOT NULL,
  `nombreHilo` varchar(20) NOT NULL,
  `numeroComentarios` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hilosforo`
--

INSERT INTO `hilosforo` (`idHilo`, `nombreHilo`, `numeroComentarios`) VALUES
(62, 'NEW IDEAS THEMES', 5),
(63, 'COOLEST POKEMONS', 3),
(64, 'GREAT HABILITIES', 4),
(66, 'WORST HABILITIES', 1),
(67, 'BEST POKE GYM', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pokemon`
--

CREATE TABLE `pokemon` (
  `IDPokemon` int(100) NOT NULL,
  `nombrePokemon` varchar(20) NOT NULL,
  `altura` int(5) NOT NULL,
  `peso` int(5) NOT NULL,
  `imagenPokemon` varchar(200) NOT NULL,
  `imagenPokemonShiny` varchar(200) NOT NULL,
  `color` varchar(20) NOT NULL,
  `hp` int(10) NOT NULL,
  `attack` int(10) NOT NULL,
  `defense` int(10) NOT NULL,
  `specialAttack` int(10) NOT NULL,
  `specialDefense` int(10) NOT NULL,
  `speed` int(10) NOT NULL,
  `FK_habitat` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pokemon`
--

INSERT INTO `pokemon` (`IDPokemon`, `nombrePokemon`, `altura`, `peso`, `imagenPokemon`, `imagenPokemonShiny`, `color`, `hp`, `attack`, `defense`, `specialAttack`, `specialDefense`, `speed`, `FK_habitat`) VALUES
(483, 'bulbasaur', 7, 69, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/1.png', 'green', 45, 49, 49, 65, 65, 45, 352),
(484, 'ivysaur', 10, 130, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/2.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/2.png', 'green', 60, 62, 63, 80, 80, 60, 352),
(485, 'venusaur', 20, 1000, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/3.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/3.png', 'green', 80, 82, 83, 100, 100, 80, 352),
(486, 'charmander', 6, 85, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/4.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/4.png', 'red', 39, 52, 43, 60, 50, 65, 353),
(487, 'charmeleon', 11, 190, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/5.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/5.png', 'red', 58, 64, 58, 80, 65, 80, 353),
(488, 'charizard', 17, 905, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/6.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/6.png', 'red', 78, 84, 78, 100, 85, 100, 353),
(489, 'squirtle', 5, 90, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/7.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/7.png', 'blue', 44, 48, 65, 50, 64, 43, 358),
(490, 'wartortle', 10, 225, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/8.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/8.png', 'blue', 59, 63, 80, 65, 80, 58, 358),
(491, 'blastoise', 16, 855, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/9.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/9.png', 'blue', 79, 83, 100, 85, 100, 78, 358),
(492, 'caterpie', 3, 29, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/10.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/10.png', 'green', 45, 30, 35, 20, 20, 45, 351),
(493, 'metapod', 7, 99, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/11.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/11.png', 'green', 50, 20, 55, 25, 25, 30, 351),
(494, 'butterfree', 11, 320, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/12.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/12.png', 'white', 60, 45, 50, 90, 80, 70, 351),
(495, 'weedle', 3, 32, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/13.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/13.png', 'brown', 40, 35, 30, 20, 20, 50, 351),
(496, 'kakuna', 6, 100, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/14.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/14.png', 'yellow', 45, 25, 50, 25, 25, 35, 351),
(497, 'beedrill', 10, 295, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/15.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/15.png', 'yellow', 65, 90, 40, 45, 80, 75, 351),
(498, 'pidgey', 3, 18, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/16.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/16.png', 'brown', 40, 45, 40, 35, 35, 56, 351),
(499, 'pidgeotto', 11, 300, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/17.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/17.png', 'brown', 63, 60, 55, 50, 50, 71, 351),
(500, 'pidgeot', 15, 395, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/18.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/18.png', 'brown', 83, 80, 75, 70, 70, 100, 351),
(501, 'rattata', 3, 35, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/19.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/19.png', 'purple', 30, 56, 35, 25, 35, 72, 352),
(502, 'raticate', 7, 185, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/20.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/20.png', 'brown', 55, 81, 60, 50, 70, 97, 352),
(503, 'spearow', 3, 20, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/21.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/21.png', 'brown', 40, 60, 30, 31, 31, 70, 355),
(504, 'fearow', 12, 380, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/22.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/22.png', 'brown', 65, 90, 65, 61, 61, 100, 355),
(505, 'ekans', 20, 69, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/23.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/23.png', 'purple', 35, 60, 44, 40, 54, 55, 352),
(506, 'arbok', 35, 650, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/24.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/24.png', 'purple', 60, 95, 69, 65, 79, 80, 352),
(507, 'pikachu', 4, 60, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/25.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/25.png', 'yellow', 35, 55, 40, 50, 50, 90, 351),
(508, 'raichu', 8, 300, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/26.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/26.png', 'yellow', 60, 90, 55, 90, 80, 100, 351),
(509, 'sandshrew', 6, 120, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/27.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/27.png', 'yellow', 50, 75, 85, 20, 30, 40, 355),
(510, 'sandslash', 10, 295, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/28.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/28.png', 'yellow', 75, 100, 100, 45, 55, 65, 355),
(511, 'nidoran-f', 4, 70, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/29.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/29.png', 'blue', 55, 47, 52, 40, 40, 41, 352),
(512, 'nidorina', 8, 200, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/30.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/30.png', 'blue', 70, 62, 67, 55, 55, 56, 352),
(513, 'nidoqueen', 13, 600, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/31.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/31.png', 'blue', 90, 92, 87, 75, 85, 76, 352),
(514, 'nidoran-m', 5, 90, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/32.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/32.png', 'purple', 46, 57, 40, 40, 40, 50, 352),
(515, 'nidorino', 9, 195, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/33.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/33.png', 'purple', 61, 72, 57, 55, 55, 65, 352),
(516, 'nidoking', 14, 620, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/34.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/34.png', 'purple', 81, 100, 77, 85, 75, 85, 352),
(517, 'clefairy', 6, 75, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/35.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/35.png', 'pink', 70, 45, 48, 60, 65, 35, 353),
(518, 'clefable', 13, 400, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/36.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/36.png', 'pink', 95, 70, 73, 95, 90, 60, 353),
(519, 'vulpix', 6, 99, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/37.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/37.png', 'brown', 38, 41, 40, 50, 65, 65, 352),
(520, 'ninetales', 11, 199, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/38.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/38.png', 'yellow', 73, 76, 75, 81, 100, 100, 352),
(521, 'jigglypuff', 5, 55, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/39.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/39.png', 'pink', 100, 45, 20, 45, 25, 20, 352),
(522, 'wigglytuff', 10, 120, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/40.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/40.png', 'pink', 100, 70, 45, 85, 50, 45, 352),
(523, 'zubat', 8, 75, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/41.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/41.png', 'purple', 40, 45, 35, 30, 40, 55, 350),
(524, 'golbat', 16, 550, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/42.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/42.png', 'purple', 75, 80, 70, 65, 75, 90, 350),
(525, 'oddish', 5, 54, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/43.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/43.png', 'blue', 45, 50, 55, 75, 65, 30, 352),
(526, 'gloom', 8, 86, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/44.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/44.png', 'blue', 60, 65, 70, 85, 75, 40, 352),
(527, 'vileplume', 12, 186, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/45.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/45.png', 'red', 75, 80, 85, 100, 90, 50, 352),
(528, 'paras', 3, 54, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/46.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/46.png', 'red', 35, 70, 55, 45, 55, 25, 351),
(529, 'parasect', 10, 295, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/47.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/47.png', 'red', 60, 95, 80, 60, 80, 30, 351),
(530, 'venonat', 10, 300, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/48.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/48.png', 'purple', 60, 55, 50, 40, 55, 45, 351),
(531, 'venomoth', 15, 125, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/49.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/49.png', 'purple', 70, 65, 60, 90, 75, 90, 351),
(532, 'diglett', 2, 8, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/50.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/50.png', 'brown', 10, 55, 25, 35, 45, 95, 350),
(533, 'dugtrio', 7, 333, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/51.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/51.png', 'brown', 35, 100, 50, 50, 70, 100, 350),
(534, 'meowth', 4, 42, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/52.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/52.png', 'yellow', 40, 45, 35, 40, 40, 90, 357),
(535, 'persian', 10, 320, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/53.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/53.png', 'yellow', 65, 70, 60, 65, 65, 100, 357),
(536, 'psyduck', 8, 196, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/54.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/54.png', 'yellow', 50, 52, 48, 65, 50, 55, 358),
(537, 'golduck', 17, 766, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/55.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/55.png', 'blue', 80, 82, 78, 95, 80, 85, 358),
(538, 'mankey', 5, 280, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/56.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/56.png', 'brown', 40, 80, 35, 35, 45, 70, 353),
(539, 'primeape', 10, 320, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/57.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/57.png', 'brown', 65, 100, 60, 60, 70, 95, 353),
(540, 'growlithe', 7, 190, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/58.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/58.png', 'brown', 55, 70, 45, 70, 50, 60, 352),
(541, 'arcanine', 19, 1550, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/59.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/59.png', 'brown', 90, 100, 80, 100, 80, 95, 352),
(542, 'poliwag', 6, 124, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/60.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/60.png', 'blue', 40, 50, 40, 40, 40, 90, 358),
(543, 'poliwhirl', 10, 200, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/61.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/61.png', 'blue', 65, 65, 65, 50, 50, 90, 358),
(544, 'poliwrath', 13, 540, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/62.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/62.png', 'blue', 90, 95, 95, 70, 90, 70, 358),
(545, 'abra', 9, 195, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/63.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/63.png', 'brown', 25, 20, 15, 100, 55, 90, 357),
(546, 'kadabra', 13, 565, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/64.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/64.png', 'brown', 40, 35, 30, 100, 70, 100, 357),
(547, 'alakazam', 15, 480, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/65.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/65.png', 'brown', 55, 50, 45, 100, 95, 100, 357),
(548, 'machop', 8, 195, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/66.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/66.png', 'gray', 70, 80, 50, 35, 35, 35, 353),
(549, 'machoke', 15, 705, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/67.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/67.png', 'gray', 80, 100, 70, 50, 60, 45, 353),
(550, 'machamp', 16, 1300, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/68.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/68.png', 'gray', 90, 100, 80, 65, 85, 55, 353),
(551, 'bellsprout', 7, 40, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/69.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/69.png', 'green', 50, 75, 35, 70, 30, 40, 351),
(552, 'weepinbell', 10, 64, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/70.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/70.png', 'green', 65, 90, 50, 85, 45, 55, 351),
(553, 'victreebel', 17, 155, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/71.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/71.png', 'green', 80, 100, 65, 100, 70, 70, 351),
(554, 'tentacool', 9, 455, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/72.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/72.png', 'blue', 40, 40, 35, 50, 100, 70, 356),
(555, 'tentacruel', 16, 550, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/73.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/73.png', 'blue', 80, 70, 65, 80, 100, 100, 356),
(556, 'geodude', 4, 200, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/74.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/74.png', 'brown', 40, 80, 100, 30, 30, 20, 353),
(557, 'graveler', 10, 1050, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/75.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/75.png', 'brown', 55, 95, 100, 45, 45, 35, 353),
(558, 'golem', 14, 3000, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/76.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/76.png', 'brown', 80, 100, 100, 55, 65, 45, 353),
(559, 'ponyta', 10, 300, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/77.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/77.png', 'yellow', 50, 85, 55, 65, 65, 90, 352),
(560, 'rapidash', 17, 950, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/78.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/78.png', 'yellow', 65, 100, 70, 80, 80, 100, 352),
(561, 'slowpoke', 12, 360, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/79.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/79.png', 'pink', 90, 65, 65, 40, 40, 15, 358),
(562, 'slowbro', 16, 785, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/80.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/80.png', 'pink', 95, 75, 100, 100, 80, 30, 358),
(563, 'magnemite', 3, 60, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/81.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/81.png', 'gray', 25, 35, 70, 95, 55, 45, 355),
(564, 'magneton', 10, 600, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/82.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/82.png', 'gray', 50, 60, 95, 100, 70, 70, 355),
(565, 'farfetchd', 8, 150, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/83.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/83.png', 'brown', 52, 90, 55, 58, 62, 60, 352),
(566, 'doduo', 14, 392, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/84.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/84.png', 'brown', 35, 85, 45, 35, 35, 75, 352),
(567, 'dodrio', 18, 852, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/85.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/85.png', 'brown', 60, 100, 70, 60, 60, 100, 352),
(568, 'seel', 11, 900, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/86.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/86.png', 'white', 65, 45, 55, 45, 70, 45, 356);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pokemonhabilidad`
--

CREATE TABLE `pokemonhabilidad` (
  `FK_pokemon` int(100) NOT NULL,
  `FK_habilidad` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pokemonhabilidad`
--

INSERT INTO `pokemonhabilidad` (`FK_pokemon`, `FK_habilidad`) VALUES
(483, 3545),
(483, 3576),
(484, 3545),
(484, 3576),
(485, 3545),
(485, 3576),
(486, 3577),
(486, 3605),
(487, 3577),
(487, 3605),
(488, 3577),
(488, 3605),
(489, 3555),
(489, 3578),
(490, 3555),
(490, 3578),
(491, 3555),
(491, 3578),
(492, 3530),
(492, 3561),
(493, 3572),
(494, 3525),
(494, 3621),
(495, 3530),
(495, 3561),
(496, 3572),
(497, 3579),
(497, 3608),
(498, 3562),
(498, 3588),
(498, 3656),
(499, 3562),
(499, 3588),
(499, 3656),
(500, 3562),
(500, 3588),
(500, 3656),
(501, 3561),
(501, 3566),
(501, 3573),
(502, 3561),
(502, 3566),
(502, 3573),
(503, 3562),
(503, 3608),
(504, 3562),
(504, 3608),
(505, 3533),
(505, 3572),
(505, 3638),
(506, 3533),
(506, 3572),
(506, 3638),
(507, 3520),
(507, 3542),
(508, 3520),
(508, 3542),
(509, 3519),
(509, 3657),
(510, 3519),
(510, 3657),
(511, 3549),
(511, 3566),
(511, 3590),
(512, 3549),
(512, 3566),
(512, 3590),
(513, 3549),
(513, 3590),
(513, 3636),
(514, 3549),
(514, 3566),
(514, 3590),
(515, 3549),
(515, 3566),
(515, 3590),
(516, 3549),
(516, 3590),
(516, 3636),
(517, 3567),
(517, 3609),
(517, 3643),
(518, 3567),
(518, 3609),
(518, 3620),
(519, 3529),
(519, 3581),
(520, 3529),
(520, 3581),
(521, 3567),
(521, 3643),
(521, 3683),
(522, 3567),
(522, 3630),
(522, 3683),
(523, 3550),
(523, 3662),
(524, 3550),
(524, 3662),
(525, 3545),
(525, 3561),
(526, 3512),
(526, 3545),
(527, 3538),
(527, 3545),
(528, 3517),
(528, 3538),
(528, 3598),
(529, 3517),
(529, 3538),
(529, 3598),
(530, 3525),
(530, 3561),
(530, 3621),
(531, 3530),
(531, 3621),
(531, 3658),
(532, 3519),
(532, 3582),
(532, 3670),
(533, 3519),
(533, 3582),
(533, 3670),
(534, 3564),
(534, 3612),
(534, 3638),
(535, 3518),
(535, 3612),
(535, 3638),
(536, 3517),
(536, 3524),
(536, 3544),
(537, 3517),
(537, 3524),
(537, 3544),
(538, 3583),
(538, 3594),
(538, 3639),
(539, 3583),
(539, 3594),
(539, 3639),
(540, 3529),
(540, 3533),
(540, 3665),
(541, 3529),
(541, 3533),
(541, 3665),
(542, 3517),
(542, 3522),
(542, 3544),
(543, 3517),
(543, 3522),
(543, 3544),
(544, 3517),
(544, 3522),
(544, 3544),
(545, 3539),
(545, 3550),
(545, 3609),
(546, 3539),
(546, 3550),
(546, 3609),
(547, 3539),
(547, 3550),
(547, 3609),
(548, 3573),
(548, 3591),
(548, 3610),
(549, 3573),
(549, 3591),
(549, 3610),
(550, 3573),
(550, 3591),
(550, 3610),
(551, 3545),
(551, 3593),
(552, 3545),
(552, 3593),
(553, 3545),
(553, 3593),
(554, 3540),
(554, 3555),
(554, 3575),
(555, 3540),
(555, 3555),
(555, 3575),
(556, 3516),
(556, 3519),
(556, 3580),
(557, 3516),
(557, 3519),
(557, 3580),
(558, 3516),
(558, 3519),
(558, 3580),
(559, 3529),
(559, 3560),
(559, 3561),
(560, 3529),
(560, 3560),
(560, 3561),
(561, 3523),
(561, 3531),
(561, 3655),
(562, 3523),
(562, 3531),
(562, 3655),
(563, 3516),
(563, 3553),
(563, 3659),
(564, 3516),
(564, 3553),
(564, 3659),
(565, 3550),
(565, 3562),
(565, 3639),
(566, 3559),
(566, 3561),
(566, 3588),
(567, 3559),
(567, 3561),
(567, 3588),
(568, 3558),
(568, 3604),
(568, 3626);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pokemonusuario`
--

CREATE TABLE `pokemonusuario` (
  `FK_usuario` int(100) NOT NULL,
  `FK_pokemon` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pokemonusuario`
--

INSERT INTO `pokemonusuario` (`FK_usuario`, `FK_pokemon`) VALUES
(10, 484),
(10, 485),
(10, 486),
(10, 489),
(10, 490);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `idTipo` int(100) NOT NULL,
  `nombreTipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`idTipo`, `nombreTipo`) VALUES
(1391, 'normal'),
(1392, 'fighting'),
(1393, 'flying'),
(1394, 'poison'),
(1395, 'ground'),
(1396, 'rock'),
(1397, 'bug'),
(1398, 'ghost'),
(1399, 'steel'),
(1400, 'fire'),
(1401, 'water'),
(1402, 'grass'),
(1403, 'electric'),
(1404, 'psychic'),
(1405, 'ice'),
(1406, 'dragon'),
(1407, 'dark'),
(1408, 'fairy'),
(1409, 'stellar'),
(1410, 'unknown');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopokemon`
--

CREATE TABLE `tipopokemon` (
  `FK_pokemon` int(100) NOT NULL,
  `FK_tipo` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipopokemon`
--

INSERT INTO `tipopokemon` (`FK_pokemon`, `FK_tipo`) VALUES
(483, 1394),
(483, 1402),
(484, 1394),
(484, 1402),
(485, 1394),
(485, 1402),
(486, 1400),
(487, 1400),
(488, 1393),
(488, 1400),
(489, 1401),
(490, 1401),
(491, 1401),
(492, 1397),
(493, 1397),
(494, 1393),
(494, 1397),
(495, 1394),
(495, 1397),
(496, 1394),
(496, 1397),
(497, 1394),
(497, 1397),
(498, 1391),
(498, 1393),
(499, 1391),
(499, 1393),
(500, 1391),
(500, 1393),
(501, 1391),
(502, 1391),
(503, 1391),
(503, 1393),
(504, 1391),
(504, 1393),
(505, 1394),
(506, 1394),
(507, 1403),
(508, 1403),
(509, 1395),
(510, 1395),
(511, 1394),
(512, 1394),
(513, 1394),
(513, 1395),
(514, 1394),
(515, 1394),
(516, 1394),
(516, 1395),
(517, 1408),
(518, 1408),
(519, 1400),
(520, 1400),
(521, 1391),
(521, 1408),
(522, 1391),
(522, 1408),
(523, 1393),
(523, 1394),
(524, 1393),
(524, 1394),
(525, 1394),
(525, 1402),
(526, 1394),
(526, 1402),
(527, 1394),
(527, 1402),
(528, 1397),
(528, 1402),
(529, 1397),
(529, 1402),
(530, 1394),
(530, 1397),
(531, 1394),
(531, 1397),
(532, 1395),
(533, 1395),
(534, 1391),
(535, 1391),
(536, 1401),
(537, 1401),
(538, 1392),
(539, 1392),
(540, 1400),
(541, 1400),
(542, 1401),
(543, 1401),
(544, 1392),
(544, 1401),
(545, 1404),
(546, 1404),
(547, 1404),
(548, 1392),
(549, 1392),
(550, 1392),
(551, 1394),
(551, 1402),
(552, 1394),
(552, 1402),
(553, 1394),
(553, 1402),
(554, 1394),
(554, 1401),
(555, 1394),
(555, 1401),
(556, 1395),
(556, 1396),
(557, 1395),
(557, 1396),
(558, 1395),
(558, 1396),
(559, 1400),
(560, 1400),
(561, 1401),
(561, 1404),
(562, 1401),
(562, 1404),
(563, 1399),
(563, 1403),
(564, 1399),
(564, 1403),
(565, 1391),
(565, 1393),
(566, 1391),
(566, 1393),
(567, 1391),
(567, 1393),
(568, 1401);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(100) NOT NULL,
  `usuario` varchar(11) NOT NULL,
  `passwordd` varchar(200) NOT NULL,
  `tipoUsuario` varchar(20) DEFAULT NULL,
  `imagenUsuario` longblob DEFAULT NULL,
  `tipoMimeImagen` varchar(50) DEFAULT NULL,
  `correo` varchar(21) NOT NULL,
  `nombre` varchar(12) NOT NULL,
  `apellido1` varchar(12) NOT NULL,
  `apellido2` varchar(12) NOT NULL,
  `telefono` int(9) NOT NULL,
  `telefono2` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `usuario`, `passwordd`, `tipoUsuario`, `imagenUsuario`, `tipoMimeImagen`, `correo`, `nombre`, `apellido1`, `apellido2`, `telefono`, `telefono2`) VALUES
(2, 'admin', '$2y$10$A0GBVkAWtTGAHahn6IKtROa0VdgVxYWq8aD0W76vvMC2jUAG6dNFe', 'administrador', NULL, NULL, 'admin@gmail.es', 'Adminn', 'Ad', 'Min', 343434349, 665655656),
(8, 'usuario1', '$2y$10$vEF1LsYLnqcd7mTyGxqW6OwbJ5kmXng/59J73vf/UPmepwCzxQeFy', 'cliente', NULL, NULL, 'user1@gmail.com', 'User1', 'User', 'Yhjsj', 125365852, NULL),
(9, 'usuario2', '$2y$10$pyh6ARXuUXlLbLgjCVc1euequ41WEQHNgZWFFeoJGlVT3qvBwlCU2', 'cliente', NULL, NULL, 'usuario2@gmail.com', 'Usuario', 'User', 'Jusyy', 458566325, 454575757),
(10, 'usuario3', '$2y$10$bqRciuiWWEKmz8igmBXgT.NrFkMaVBhWIuVfUooTKV1QKx2Ie/Hee', 'cliente', NULL, NULL, 'usuar3@hotmail.com', 'Usuario3', 'User', 'Jisisi', 458693254, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariopuntuacioncomentario`
--

CREATE TABLE `usuariopuntuacioncomentario` (
  `FK_usuario` int(100) NOT NULL,
  `FK_comentario` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuariopuntuacioncomentario`
--

INSERT INTO `usuariopuntuacioncomentario` (`FK_usuario`, `FK_comentario`) VALUES
(2, 491),
(2, 499),
(2, 506),
(8, 491),
(8, 493),
(8, 496),
(9, 496),
(9, 497),
(9, 499),
(9, 500),
(10, 491),
(10, 497),
(10, 499),
(10, 502);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `FK_hilo` (`FK_hilo`),
  ADD KEY `FK_usuario` (`FK_usuario`);

--
-- Indices de la tabla `frasespokemon`
--
ALTER TABLE `frasespokemon`
  ADD PRIMARY KEY (`idFrase`),
  ADD KEY `FK_pokemon` (`FK_pokemon`);

--
-- Indices de la tabla `habilidad`
--
ALTER TABLE `habilidad`
  ADD PRIMARY KEY (`idHabilidad`);

--
-- Indices de la tabla `habitat`
--
ALTER TABLE `habitat`
  ADD PRIMARY KEY (`idHabitat`);

--
-- Indices de la tabla `hilosforo`
--
ALTER TABLE `hilosforo`
  ADD PRIMARY KEY (`idHilo`);

--
-- Indices de la tabla `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`IDPokemon`),
  ADD KEY `FK_habitat` (`FK_habitat`);

--
-- Indices de la tabla `pokemonhabilidad`
--
ALTER TABLE `pokemonhabilidad`
  ADD PRIMARY KEY (`FK_pokemon`,`FK_habilidad`),
  ADD KEY `FK_pokemon` (`FK_pokemon`),
  ADD KEY `FK_habilidad` (`FK_habilidad`),
  ADD KEY `FK_pokemon_2` (`FK_pokemon`),
  ADD KEY `FK_pokemon_3` (`FK_pokemon`,`FK_habilidad`);

--
-- Indices de la tabla `pokemonusuario`
--
ALTER TABLE `pokemonusuario`
  ADD PRIMARY KEY (`FK_usuario`,`FK_pokemon`),
  ADD KEY `FK_usuario` (`FK_usuario`,`FK_pokemon`),
  ADD KEY `FK_pokemon` (`FK_pokemon`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`idTipo`);

--
-- Indices de la tabla `tipopokemon`
--
ALTER TABLE `tipopokemon`
  ADD PRIMARY KEY (`FK_pokemon`,`FK_tipo`),
  ADD KEY `FK_pokemon` (`FK_pokemon`,`FK_tipo`),
  ADD KEY `FK_tipo` (`FK_tipo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `usuariopuntuacioncomentario`
--
ALTER TABLE `usuariopuntuacioncomentario`
  ADD PRIMARY KEY (`FK_usuario`,`FK_comentario`),
  ADD KEY `FK_usuario` (`FK_usuario`,`FK_comentario`),
  ADD KEY `FK_comentario` (`FK_comentario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `idComentario` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=508;

--
-- AUTO_INCREMENT de la tabla `frasespokemon`
--
ALTER TABLE `frasespokemon`
  MODIFY `idFrase` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=924;

--
-- AUTO_INCREMENT de la tabla `habilidad`
--
ALTER TABLE `habilidad`
  MODIFY `idHabilidad` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3689;

--
-- AUTO_INCREMENT de la tabla `habitat`
--
ALTER TABLE `habitat`
  MODIFY `idHabitat` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=359;

--
-- AUTO_INCREMENT de la tabla `hilosforo`
--
ALTER TABLE `hilosforo`
  MODIFY `idHilo` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `pokemon`
--
ALTER TABLE `pokemon`
  MODIFY `IDPokemon` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=569;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `idTipo` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1411;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`FK_hilo`) REFERENCES `hilosforo` (`idHilo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`FK_usuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `frasespokemon`
--
ALTER TABLE `frasespokemon`
  ADD CONSTRAINT `frasespokemon_ibfk_1` FOREIGN KEY (`FK_pokemon`) REFERENCES `pokemon` (`IDPokemon`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pokemon`
--
ALTER TABLE `pokemon`
  ADD CONSTRAINT `pokemon_ibfk_1` FOREIGN KEY (`FK_habitat`) REFERENCES `habitat` (`idHabitat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pokemonhabilidad`
--
ALTER TABLE `pokemonhabilidad`
  ADD CONSTRAINT `pokemonhabilidad_ibfk_1` FOREIGN KEY (`FK_habilidad`) REFERENCES `habilidad` (`idHabilidad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pokemonhabilidad_ibfk_2` FOREIGN KEY (`FK_pokemon`) REFERENCES `pokemon` (`IDPokemon`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pokemonusuario`
--
ALTER TABLE `pokemonusuario`
  ADD CONSTRAINT `pokemonusuario_ibfk_1` FOREIGN KEY (`FK_pokemon`) REFERENCES `pokemon` (`IDPokemon`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pokemonusuario_ibfk_2` FOREIGN KEY (`FK_usuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipopokemon`
--
ALTER TABLE `tipopokemon`
  ADD CONSTRAINT `tipopokemon_ibfk_1` FOREIGN KEY (`FK_tipo`) REFERENCES `tipo` (`idTipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tipopokemon_ibfk_2` FOREIGN KEY (`FK_pokemon`) REFERENCES `pokemon` (`IDPokemon`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuariopuntuacioncomentario`
--
ALTER TABLE `usuariopuntuacioncomentario`
  ADD CONSTRAINT `usuariopuntuacioncomentario_ibfk_1` FOREIGN KEY (`FK_usuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuariopuntuacioncomentario_ibfk_2` FOREIGN KEY (`FK_comentario`) REFERENCES `comentario` (`idComentario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
