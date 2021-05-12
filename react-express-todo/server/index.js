const express = require('express');
const bodyParser = require('body-parser');
const app = express();
const port = 3000;
const routes = require('./routes.js');

app.use(bodyParser.json());
app.use(express.static('dist'));

routes(app);

app.listen(port,()=>{
  console.log(`Example app listening at http://loclhost:${port}`);
});