import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';

class RankTable extends React.Component {
  render() {
    return (
      <div>
      </div>
    );
  }
}

class Game extends React.Component {
  render() {
    return (
      <div className="rank-table">
        <RankTable />
      </div>
    );
  }
}

ReactDOM.render(
  <Game />, document.getElementById('root')
);
