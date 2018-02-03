<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

// Get All Cinemas
$app->get('/api/cinemas', function (Request $request, Response $response) {
    $sql = 'SELECT * FROM cinemas';

    try{
        // Get DB Oject
$db = new db();
// Connect
$db = $db->connect();

$stmt = $db->query($sql);
$cinemas = $stmt->fetchAll(PDO::FETCH_OBJ);
$db= null;
echo json_encode($cinemas,JSON_UNESCAPED_SLASHES);
    }catch(PDOException $e){
echo '{"error":{"text":'.$e->getMessage().'}}';
    }
});


// Get Single Cinema 
$app->get('/api/cinema/{id}', function (Request $request, Response $response) {
   $id = $request->getAttribute('id');
    $sql = "SELECT * FROM cinemas WHERE id = $id";

    try{
        // Get DB Oject
$db = new db();
// Connect
$db = $db->connect();

$stmt = $db->query($sql);
$cinema = $stmt->fetchAll(PDO::FETCH_OBJ);
$db= null;
echo json_encode($cinema,JSON_UNESCAPED_SLASHES);
    }catch(PDOException $e){
echo '{"error":{"text":'.$e->getMessage().'}}';
    }
});



// Add Cinema 
$app->post('/api/cinema/{add}', function (Request $request, Response $response) {
    $cinemaname = $request->getParam('cinemaname');
    $title = $request->getParam('title');
    $synopsis = $request->getParam('synopsis');
    $vrating = $request->getParam('vrating');
    $starring = $request->getParam('starring');
    $runningtime = $request->getParam('runningtime');
    $showtimes = $request->getParam('showtimes');
    $trailerlink = $request->getParam('trailerlink');
    $imagelink = $request->getParam('imagelink');
    $state = $request->getParam('state');
    $area = $request->getParam('area');
    $extras = $request->getParam('extras');
       

    $sql = "INSERT INTO `cinemas` (`cinemaname`, `title`, `synopsis`, `vrating`, `starring`, 
    `runningtime`, `showtimes`, `trailerlink`, `imagelink`, `state`, `area`, `extras`) VALUES 
    ( :cinemaname, :title, :synopsis, :vrating, :starring, :runningtime, :showtimes, :trailerlink,
     :imagelink, :state, :area, :extras)";

    try{
        // Get DB Oject
$db = new db();
// Connect
$db = $db->connect();

$stmt = $db->prepare($sql);

$stmt->bindParam(':cinemaname', $cinemaname);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':synopsis', $synopsis);
$stmt->bindParam(':vrating', $vrating);
$stmt->bindParam(':starring', $starring);
$stmt->bindParam(':runningtime', $runningtime);
$stmt->bindParam(':showtimes', $showtimes);
$stmt->bindParam(':trailerlink', $trailerlink);
$stmt->bindParam(':imagelink', $imagelink);
$stmt->bindParam(':state', $state);
$stmt->bindParam(':area', $area);
$stmt->bindParam(':extras', $extras);

$stmt->execute();

echo '{"notice":{"text": "Cinema Added"}';

    }catch(PDOException $e){
echo '{"error":{"text":'.$e->getMessage().'}}';
    }
});

// Update Cinema 
$app->put('/api/cinema/update/{id}', function (Request $request, Response $response) {

 $id = $request->getAttribute('id');

    $cinemaname = $request->getParam('cinemaname');
    $title = $request->getParam('title');
    $synopsis = $request->getParam('synopsis');
    $vrating = $request->getParam('vrating');
    $starring = $request->getParam('starring');
    $runningtime = $request->getParam('runningtime');
    $showtimes = $request->getParam('showtimes');
    $trailerlink = $request->getParam('trailerlink');
    $imagelink = $request->getParam('imagelink');
    $state = $request->getParam('state');
    $area = $request->getParam('area');
    $extras = $request->getParam('extras');
       

    $sql = "UPDATE `cinemas` SET
     cinemaname = :cinemaname,
      title  = :title,
      synopsis =:synopsis,
      vrating =:vrating,
      starring =:starring,
      runningtime =:runningtime,
      showtimes =:showtimes,
      trailerlink =:trailerlink,
      imagelink =:imagelink,
      state =:state,
      area =:area,
      extras =:extras 
    WHERE id = $id";

    try{
        // Get DB Oject
$db = new db();
// Connect
$db = $db->connect();

$stmt = $db->prepare($sql);

$stmt->bindParam(':cinemaname', $cinemaname);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':synopsis', $synopsis);
$stmt->bindParam(':vrating', $vrating);
$stmt->bindParam(':starring', $starring);
$stmt->bindParam(':runningtime', $runningtime);
$stmt->bindParam(':showtimes', $showtimes);
$stmt->bindParam(':trailerlink', $trailerlink);
$stmt->bindParam(':imagelink', $imagelink);
$stmt->bindParam(':state', $state);
$stmt->bindParam(':area', $area);
$stmt->bindParam(':extras', $extras);

$stmt->execute();

echo '{"notice":{"text": "Cinema Updated"}';

    }catch(PDOException $e){
echo '{"error":{"text":'.$e->getMessage().'}}';
    }
});



// Delete Cinema 
$app->delete('/api/cinema/delete/{id}', function (Request $request, Response $response) {
   $id = $request->getAttribute('id');
    $sql = "DELETE FROM cinemas WHERE id = $id";

    try{
        // Get DB Oject
$db = new db();
// Connect
$db = $db->connect();

$stmt = $db->prepare($sql);
$stmt->execute();
$db= null;
echo '{"notice":{"text": "Cinema Deleted"}';
    }catch(PDOException $e){
echo '{"error":{"text":'.$e->getMessage().'}}';
    }
});
