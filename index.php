<!DOCTYPE html>
<html>
<head>
  <title>Form Example</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #fbfbff;
    }

    h1 {
      text-align: center;
    }

    form {
      max-width: 400px;
      margin: 0 auto;
      background-color: #f5f5f5;
/*      padding: 20px;*/
      padding: 20px 50px 20px 20px;
      border-radius: 5px;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 3px;
      border: 1px solid #ccc;
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #4caf50;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      margin-top: 10px;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .analyse_form {
      width: 100%;
      padding: 10px;
      background-color: #0000F1;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      margin-top: 10px;
    }

    .error {
      color: #ff0000;
      margin-top: 5px;
    }
  </style>
</head>
<body>
  <h1>Form Example</h1>
  <!-- catch me BEGIN -->
  <div>  
    <font color="blue">Deprecated Font Tag</font>
    <button onclick="myFunction()">Click me</button>
    <div style="color: red; font-size: 20px;">Piece of ....</div>
  </div>
  <div>
    <p>Paragraph 1</p>
    <br>
    <p>Paragraph 2</p>
    <br>
    <p>Paragraph 3</p>
</div>
  
  <!-- catch me END --->
  <form method="POST" action="">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
 
    <label for="age">Age:</label>
    <input type="number" id="age" name="age" required>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}" required>

    <label for="date">Date of Birth:</label>
    <input type="date" id="date" name="date" required>

    <!-- Add more fields as needed -->

    <input type="submit" value="Submit">
    
    <button type="button" class="analyse_form" onclick="takeScreenshotAndUpload()">
        Analyse Form
    </button>
    
  </form>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
      // function takeScreenshot() {
      //     html2canvas(document.body).then(function(canvas) {
      //       // Convert the canvas to a data URL
      //       var imageData = canvas.toDataURL('image/png');

      //       // Create a FormData object to send the image data
      //       var formData = new FormData();
      //       formData.append('imageData', imageData);

      //       // Send the data to the PHP backend using a fetch request
      //       fetch('upload.php', {
      //         method: 'POST',
      //         body: formData
      //     })
      //       .then(function(response) {
      //         if (response.ok) {
      //           console.log('Screenshot uploaded successfully.');
      //       } else {
      //           console.error('Error uploading screenshot:', response.statusText);
      //       }
      //   })
      //       .catch(function(error) {
      //         console.error('Error uploading screenshot:', error);
      //     });
      //   });
      // }
  </script>
  <script type="text/javascript">

    // Function to take a screenshot of the current page and upload as a file attachment
    function takeScreenshotAndUpload() {
      // Capture the screenshot using html2canvas
      html2canvas(document.body).then(function(canvas) {
        // Convert the canvas to a data URL
        var imageData = canvas.toDataURL('image/png');

        // Convert the data URL to a Blob
        var blobData = dataURItoBlob(imageData);

        // Create a FormData object
        var formData = new FormData();
        // formData.append('screenshot', blobData, `screenshot_${generateUniqueId()}.png`);
        formData.append('screenshot', blobData, 'screenshot.png');

        // Send the FormData to the upload script using fetch
        fetch('upload.php', {
          method: 'POST',
          body: formData
        })
        .then(function(response) {
          if (response.ok) {
            console.log('Screenshot uploaded successfully.');
          } else {
            console.error('Error uploading screenshot:', response.statusText);
          }
        })
        .catch(function(error) {
          console.error('Error uploading screenshot:', error);
        });
      });
    }

    // Helper function to convert a data URI to a Blob object
    function dataURItoBlob(dataURI) {
      var byteString = atob(dataURI.split(',')[1]);
      var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
      var ab = new ArrayBuffer(byteString.length);
      var ia = new Uint8Array(ab);
      for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
      }
      return new Blob([ab], { type: mimeString });
    }

    function generateUniqueId() {
      // Get the current timestamp in milliseconds
      var timestamp = Date.now();

      // Generate a random number to add to the timestamp
      var randomNum = Math.floor(Math.random() * 1000);

      // Combine the timestamp and random number to create the unique ID
      var uniqueId = timestamp.toString() + randomNum.toString();

      return uniqueId;
    }
  </script>
  <script>
    // JavaScript validation
    document.querySelector('form').addEventListener('submit', function(event) {
      var name = document.getElementById('name').value;
      var age = document.getElementById('age').value;
      var email = document.getElementById('email').value;
      var date = document.getElementById('date').value;

      var errorMessages = [];

      // Validate name
      if (name.trim() === '') {
        errorMessages.push('Name is required.');
      }

      // Validate age
      if (age.trim() === '') {
        errorMessages.push('Age is required.');
      } else if (isNaN(age)) {
        errorMessages.push('Age must be a number.');
      }

      // Validate email
      if (email.trim() === '') {
        errorMessages.push('Email is required.');
      } else if (!email.match(/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/)) {
        errorMessages.push('Email is invalid.');
      }

      // Validate date
      if (date.trim() === '') {
        errorMessages.push('Date of Birth is required.');
      }

      // Display error messages or submit the form
      if (errorMessages.length > 0) {
        event.preventDefault();
        var errorContainer = document.createElement('div');
        errorContainer.className = 'error';
        errorContainer.textContent = errorMessages.join(' ');
        document.querySelector('form').appendChild(errorContainer);
      }
    });
  </script>
</body>
</html>
