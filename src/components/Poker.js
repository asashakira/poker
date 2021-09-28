import { useState } from 'react'
import Cards from './Cards'
import Button from './Button'

const Poker = ({ deck }) => {
  const [cards, setCards] = useState([
    deck[0], deck[1], deck[2], deck[3], deck[4],
  ]);

  const changeCards = () => {
    let change = [0, 0, 0, 0, 0];
    for (let i = 0; i < 5; i++) {
      change[i] = document.getElementById(`img-${cards[i]}`).checked ? 5 : 0;
    }
    setCards([
      deck[change[0]], deck[1 + change[1]], deck[2 + change[2]], deck[3 + change[3]], deck[4 + change[4]],
    ]);

    judge();
  }

  const judge = () => {
    console.log("judge");
  }

  return (
    <>
      <Cards cards={cards} />
      <Button
        onClick={changeCards}
      />
    </>
  );
}

export default Poker
