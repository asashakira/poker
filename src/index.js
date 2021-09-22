import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';

function Navbar() {
  return (
    <div className="title"> P<i className="fas fa-heart heart"></i>ker </div>
  );
}

function RankTable() {
  const rankNames = [
    "ツーペア",
    "スリーカード",
    "ストレート",
    "フラッシュ",
    "フルハウス",
    "フォーカード",
    "ストレートフラッシュ",
    "ファイブカード",
    "ロイヤルストレートフラッシュ",
    "ロイヤルストレートスライム",
  ];

  return (
    <div className="grid">
    </div>
  );
}

class Game extends React.Component {
  render() {
    return (
      <div>
      </div>
    );
  }
}

ReactDOM.render( <Navbar />, document.getElementById('navbar') );
ReactDOM.render( <RankTable />, document.getElementById('rank-table') );
ReactDOM.render( <Game />, document.getElementById('game') );
