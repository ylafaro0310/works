var mysql = require('mysql');
var pool = mysql.createPool({
  connectionLimit: 10,
  host: 'mysql',
  user: 'default',
  password: 'default',
  database: 'react_express_todo',
});

exports.all_todos = (req,res) => {
  pool.query('SELECT * FROM todos',(err,rows,fields)=>{
    if(err) res.send(err);

    res.json(rows);
  });
};

exports.create_todo = (req,res) => {
  var todo_name = req.body.todo_name;
  var is_completed = req.body.is_completed;
  pool.query('INSERT INTO todos SET todo_name = ?, is_completed = ?',[todo_name, is_completed],(err,rows,fields)=>{
    if(err) res.send(err);
  
    res.send('Created');
  });
};

exports.update_todo = (req,res) => {
  var todoId = req.params.todoId;
  var is_completed = req.body.is_completed;
  pool.query('UPDATE todos SET is_completed = ? WHERE id = ?',[is_completed,todoId],(err,rows,fields)=>{
    if(err) res.send(err);
    
    res.send('Updated');
  });
};

exports.delete_todo = (req,res) => {
  var todoId = req.params.todoId;
  pool.query('DELETE FROM todos WHERE id = ?',[todoId],(err,rows,fields)=>{
    if(err) res.send(err);
    
    res.send('Deleted');
  });
};