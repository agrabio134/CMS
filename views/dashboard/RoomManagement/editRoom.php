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
    <form action="/cms/room/modifyRoom" method="post">
        <input type="hidden" name="id" value="<?php echo $room->id; ?>">
        <input type="text" name="roomName" placeholder="Room Name" value="<?php echo $room->roomName; ?>">
        <!-- add selection in room type -->
        <select name="roomType" id="roomType">
            <option value="single">Single</option>
            <option value="double">Double</option>
            <option value="family">Family</option>
            <option value="suite">Suite</option>
        </select>
        <input type="text" name="roomPrice" placeholder="Room Price" value="<?php echo $room->roomPrice; ?>">
        <!-- add room status -->
        <select name="roomStatus" id="roomStatus">
            <option value="available">Available</option>
            <option value="occupied">Occupied</option>
            <option value="reserved">Reserved</option>
            <option value="outOfOrder">Out of Order</option>
        </select>
        <input type="text" name="roomDescription" placeholder="Room Description" value="<?php echo $room->roomDescription; ?>">
        <!-- room image -->
        <input type="file" name="roomImage" placeholder="Room Image" value="<?php echo $room->roomImage; ?>">
        <input type="submit" value="Submit">








</body>

</html>