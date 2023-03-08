<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
</head>
<body>

    <h1>Events</h1>
    <form action="/cms/events/addEvent" method="post">
        <input type="text" name="title" placeholder="Title">
        <input type="text" name="description" placeholder="Description">
        <!-- add date picker -->
        <input type="date" name="date" placeholder="Date">
        <!-- add time picker -->
        <input type="time" name="time" placeholder="Time">
        <!-- add image -->
        <input type="file" name="image" placeholder="Image">
      
        <input type="submit" value="Submit">
    </form>
    
</body>
</html>