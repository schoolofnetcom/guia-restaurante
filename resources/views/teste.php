<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<form id="form">
    <input type="text" name="name" value="Erik's bar">
    <input type="text" name="description" value="Melhor Wiski da região">
    <input type="file" name="photo" id="file">
</form>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript">

  $('#file').on('change', function () {

    let formData = new FormData();
    formData.append('name', 'Erik\'s bar');
    formData.append('description', 'Melhor Wiski da região');
    formData.append('photo', $('#file')[0].files[0]);

    let headers = {
      'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImIwOWYwZGVkMzEzZTQyMmE5ZTU0MTIwNDY0NmNiNmI2OTBmZWQ1ZWI0NGI2ZGExNjc2ZTA5YzQzZGZlNzRkYjM4NDM5NmJjOGJhODQ0YTFkIn0.eyJhdWQiOiIzIiwianRpIjoiYjA5ZjBkZWQzMTNlNDIyYTllNTQxMjA0NjQ2Y2I2YjY5MGZlZDVlYjQ0YjZkYTE2NzZlMDljNDNkZmU3NGRiMzg0Mzk2YmM4YmE4NDRhMWQiLCJpYXQiOjE1MDI0NjAyMzksIm5iZiI6MTUwMjQ2MDIzOSwiZXhwIjoxNTMzOTk2MjM5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.KJ9breHF93No5ctXClsWAwihiRneYcmYxO4kAXHEMkmW7oirr2zDYx48Pp9BKK7uzttwFIpMPU832M21tfMNGLipkcBLGObnEWMQJ3p3cgd2xN72EM7M2-d1tRc9L-ztkfi-q4Sa67OCVATYw4EmeScuxlBWfDdIV_x4RmwHjqX3uUw5Sa_fso61cr7zFHwpycxPBG3Z66QzZCiwd7CywQvN0IWFpUfa_zcPr20KjFrKMP2Ny3l0RCLFspAiFRKJXwkYMsS-KxeKUZdyNdCE7raFwP2UurVxTfepgG3xz73PCRjnrZ03XR56h5bKKY6YD-nfZH8YhTbpiVkAROHi5E21cxdaC2NDYXSBSYQnVC4LEmeN-sMJam0Cmef_2XC7P6Z1sDMCaFLMUNt24L00uokQmQpu_JGj0Gx3s4euwuXCjJs1mh66FNmX0yMxLHTnhhVYAtMHnLCbHSjSC2OCJJNTtnZwoe22PaFGHL1B6ulLQniQAm260uqHhWm78cXbUhZNq2__fBx6T5wEIAGTVGGEBp6BLOuaomsWnS5-pMTB4I7DB9ow2Qd9oOquvw88SsOoe62iIbu2lF0teivL7jWbcqlszDLNgQBHeVX7O4eiESMPEnP9Zyl8b8wirCIshtStCqvsISIicwhkyJZuJGU8cdl_yg_W9tPyI-a-Ogo',
      //'content-type': 'multipart/form-data'
      'content-type': 'application/x-www-form-urlencoded'
    }

    axios.post('http://localhost:8000/api/v1/restaurants/2', formData, {headers: headers})
  })
</script>
</body>
</html>