<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room</title>
</head>

<body>

    <!-- edit room  get by id-->
    <h1>Edit Room</h1>

    <!-- form about editting room details in hotel  -->
    <form action="/cms/room/modifyRoom" method="post"  enctype="multipart/form-data"> 
        <?php foreach ($rooms as $room) : ?>
            <input type="hidden" name="id" value="<?php echo $room['id']; ?>">
            <img src="/media/rooms/<?php echo $room['image']; ?>" alt="Room Image" width="100px" id="roomImage">
            <input type="file" name="roomImage" id="roomImage" >
            <label for="roomNumber">Room Number</label>
            <input type="number" name="roomNumber" placeholder="<?php echo $room['room_number']; ?>" value="">
            <select name="CategoryName" id="CategoryName">
                <option value="single">Single</option>
                <option value="double">Double</option>
                <option value="family">Family</option>
                <option value="suite">Suite</option>
            </select>
            <input type="text" name="roomPrice" placeholder="<?php echo $room['price']; ?>" value="">.
            <select name="roomStatus" id="roomStatus">
                <option value="available">Available</option>
                <option value="occupied">Occupied</option>
                <option value="reserved">Reserved</option>
                <option value="outOfOrder">Out of Order</option>
            </select>
            <input type="text" name="roomDescription" placeholder="<?php echo $room['description']; ?>" value="">











        <?php endforeach; ?>
        <input type="submit" value="Submit">








</body>

</html>