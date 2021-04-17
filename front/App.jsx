import React from 'react';
import axios from 'axios';
import { Box, Button, Checkbox, Container, IconButton, List, ListItem, ListItemIcon, ListItemSecondaryAction, ListItemText, TextField } from '@material-ui/core';
import DeleteIcon from '@material-ui/icons/Delete';

class App extends React.Component {
  constructor(props){
    super(props);

    this.state = {
      todos: [],
      new_todo: '',
    };

    this.handleChange = this.handleChange.bind(this);
    this.handleToggle = this.handleToggle.bind(this);
    this.handleCreate = this.handleCreate.bind(this);
    this.handleDelete = this.handleDelete.bind(this);
  }

  componentDidMount(){
    axios.get('/api/todos')
      .then((response)=>{
        this.setState({
          todos: Object.assign([],response.data)
        });
      })
      .catch((error)=>{
        console.log(error);
      });
  }

  handleCreate(){
    const { new_todo } = this.state;
    if(new_todo){
      axios.post('/api/todos',{
        todo_name: new_todo,
        is_completed: false,
      })
        .then((response)=>{
          console.log(response);
          axios.get('/api/todos')
            .then((response)=>{
              this.setState({
                todos: Object.assign([],response.data)
              });
            })
            .catch((error)=>{
              console.log(error);
            });
        })
        .catch((error)=>{
          console.log(error);
        });
    }
  }
  
  handleChange(event){
    this.setState({
      new_todo: event.target.value,
    });
  }

  handleToggle(todoId){
    let { todos } = this.state;

    let i = todos.findIndex((elem)=>(elem.id == todoId));
    axios.put('/api/todos/'+todoId,{
      is_completed: !todos[i].is_completed,
    })
      .then((response)=>{
        console.log(response);
        axios.get('/api/todos')
          .then((response)=>{
            this.setState({
              todos: Object.assign([],response.data)
            });
          })
          .catch((error)=>{
            console.log(error);
          });
      })
      .catch((error)=>{
        console.log(error);
      });
   
  }

  handleDelete(todoId){
    axios.delete('/api/todos/'+todoId)
      .then((response)=>{
        console.log(response);
        axios.get('/api/todos')
          .then((response)=>{
            this.setState({
              todos: Object.assign([],response.data)
            });
          })
          .catch((error)=>{
            console.log(error);
          });
      })
      .catch((error)=>{
        console.log(error);
      });
  }
  
  render(){
    const { todos, new_todo } = this.state;
    return (
      <Container maxWidth="sm">
        <form>
          <Box display="flex" alignItems="center">
            <TextField label="Todo Name" value={new_todo} onChange={this.handleChange}/>
            <Button variant="contained" color="primary" onClick={this.handleCreate}>Create Todo</Button>
          </Box>
        </form>
        <List>
          {todos.map((elem,i)=>(
            <ListItem key={i} button onClick={()=>this.handleToggle(elem.id)}>
              <ListItemIcon>
                <Checkbox checked={Boolean(elem.is_completed)}/>
              </ListItemIcon>
              <ListItemText primary={elem.todo_name}/>
              <ListItemSecondaryAction>
                <IconButton edge="end" onClick={()=>this.handleDelete(elem.id)}>
                  <DeleteIcon />
                </IconButton>
              </ListItemSecondaryAction>
            </ListItem>
          ))}
        </List>
      </Container>
    ); 
  }
}

export default App;
