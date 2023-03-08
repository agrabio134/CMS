<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room</title>
</head>

<body>

    <h1>Room</h1>

    <!-- form about editting room details in hotel  -->
    <form action="/cms/room/addRoom" method="post">

    <!-- temporary, this should get the room from the database -->
        <input type="number" name="roomNumber" placeholder="Room number">

        <!-- add selection in room type -->
        <select name="roomType" id="roomType">
            <option value="single">Single</option>
            <option value="double">Double</option>
            <option value="family">Family</option>
            <option value="suite">Suite</option>
        <input type="text" name="roomPrice" placeholder="Room Price">

            <!-- add room status -->
        <select name="roomStatus" id="roomStatus">
            <option value="available">Available</option>
            <option value="occupied">Occupied</option>
            <option value="reserved">Reserved</option>
            <option value="outOfOrder">Out of Order</option>
        <input type="text" name="roomDescription" placeholder="Room Description">
            <!-- room image -->
        <input type="file" name="roomImage" placeholder="Room Image">
        <input type="submit" value="Submit">
        

    </form>

    <!-- view room in table  -->
    <table>
        <tr>
            <th>Room Number</th>
            <th>Room Type</th>
            <th>Room Price</th>
            <th>Room Status</th>
            <th>Room Description</th>
            <th>Room Image</th>
            <th>Action</th>
        </tr>

        <!-- temporary, this should get the room from the database -->
        <tr>
            <td>Room 1</td>
            <td>Single</td>
            <td>100</td>
            <td>Available</td>
            <td>Room 1</td>
            <td>Room 1</td>
            <td>
                <a href="/cms/room/editRoom">Edit</a>
                <a href="/cms/room/deleteRoom">Delete</a>
            </td>
        </tr>


<!-- use code below if may database na for the room -->
        <!-- <?php foreach ($rooms as $room) : ?>
            <tr>
                <td><?= $room->roomNumber ?></td>
                <td><?= $room->roomType ?></td>
                <td><?= $room->roomPrice ?></td>
                <td><?= $room->roomStatus ?></td>
                <td><?= $room->roomDescription ?></td>
                <td><?= $room->roomImage ?></td>
                 <td>
                <a href="/cms/room/editRoom">Edit</a>
                <a href="/cms/room/deleteRoom">Delete</a>
            </td>
            </tr>
        


        <?php endforeach; ?> -->


        
    </table>
    



</body>

</html>