import { useState } from 'react'
import Poker from './Poker'

const Game = ({ ranks }) => {
  const [deck, setDeck] = useState(() => initDeck());

  const shuffle = () => {
    setDeck(() => initDeck());
  }

  return <Poker deck={deck} shuffle={shuffle} ranks={ranks} />
}

const initDeck = () => {
  let D = [];
  for (let i = 0; i < 52; i++) {
    D.push(i);
  }
  for (let i = 0; i < 52; i++) {
    const r = Math.floor(Math.random() * 51);
    [D[i], D[r]] = [D[r], D[i]]
  }
  return D;
}

export default Game
