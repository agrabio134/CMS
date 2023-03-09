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

    <!-- form about editing room details in hotel  -->
    <form action="/cms/room/addRoom" method="post" enctype="multipart/form-data">
        <input type="number" name="roomNumber" placeholder="Room number">
        <select name="CategoryName" id="CategoryName">
            <option value="single">Single</option>
            <option value="double">Double</option>
            <option value="family">Family</option>
            <option value="suite">Suite</option>
        </select>
        <input type="text" name="roomPrice" placeholder="Room Price">
        <select name="roomStatus" id="roomStatus">
            <option value="available">Available</option>
            <option value="occupied">Occupied</option>
            <option value="reserved">Reserved</option>
            <option value="outOfOrder">Out of Order</option>
        </select>
        <input type="text" name="roomDescription" placeholder="Room Description">
        <label for="media">Media</label>
        <input type="file" name="roomImage" id="roomImage" required>
        <!-- <input type="file" name="roomImage" placeholder="Room Image"> -->
        <input type="submit" value="Submit">
    </form>


    <!-- view room in table  -->
    <table>
        <tr>
            <th>Room Number</th>
            <th>Room Status</th>
            <th>Room category</th>
            <th>Room Price</th>
            <th>Room Description</th>
            <th>Room Image</th>
            <th>Action</th>
        </tr>

        <!-- use code below if may database na for the room -->
        <?php foreach ($rooms as $room) : ?>
            <tr>
                <td><?php echo $room['room_number']; ?></td>
                <td><?php echo $room['status']; ?></td>
                <td><?php echo $room['name']; ?></td>
                <td><?php echo $room['price']; ?></td>

                <td><?php echo $room['description']; ?></td>
                <td><img src="/media/rooms/<?php echo $room['image']; ?>" alt="Room Image" width="100px"></td>
                
                <td>
                    <a href="/cms/room/editRoom?id=<?php echo $room['id']; ?>">Edit</a>
                    <a href="/cms/room/deleteRoom?id=<?php echo $room['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".room-price").blur(function() {
                var roomId = $(this).data("room-id");
                var price = $(this).text();

                $.ajax({
                    url: "/cms/room/updateRoomPrice",
                    type: "POST",
                    data: {
                        roomId: roomId,
                        price: price
                    },
                    success: function(response) {
                        // Handle success response from server
                        alert("Room price updated successfully!");
                    },
                    error: function(xhr, status, error) {
                        // Handle error response from server
                        alert("Failed to update room price: " + error);
                    }
                })
            });
        });
    </script>