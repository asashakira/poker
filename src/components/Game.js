import Cards from './Cards'
import Button from './Button'

const Game = () => {
  let A = [];
  for (let i = 0; i < 52; i++) {
    A.push(i);
  }
  for (let i = 0; i < 52; i++) {
    const r = Math.floor(Math.random() * 51);
    [A[i], A[r]] = [A[r], A[i]]
  }
  console.log(A);

  const change = () => {
    console.log("HI");
  }

  return (
    <>
      <Cards cards={A} />
      <Button
        onClick={change}
      />
    </>
  );
}

export default Game
