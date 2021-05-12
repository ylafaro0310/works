module.exports = function(app){
  var todos = require('./controllers/todoControllers');

  app.route('/api/todos')
    .get(todos.all_todos)
    .post(todos.create_todo);

  app.route('/api/todos/:todoId')
    .put(todos.update_todo)
    .delete(todos.delete_todo);
};