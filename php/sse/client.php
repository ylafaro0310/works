<html>
<body>
<script type="text/javascript">
    var evtSource = new EventSource("//localhost:8000/ssedemo.php");
    console.log(evtSource);
    evtSource.onmessage = function(e) {
    var newElement = document.createElement("li");
    var eventList = document.getElementById('list');

    newElement.innerHTML = "message: " + e.data;
    eventList.appendChild(newElement);
}
</script>
<div id="list">
</div>
</body>
</html>