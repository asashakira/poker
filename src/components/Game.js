import Poker from './Poker'

const Game = () => {
  let deck = [];
  for (let i = 0; i < 52; i++) {
    deck.push(i);
  }
  for (let i = 0; i < 52; i++) {
    const r = Math.floor(Math.random() * 51);
    [deck[i], deck[r]] = [deck[r], deck[i]]
  }

  return (
    <>
      <Poker deck={deck} />
    </>
  );
}

export default Game
