
const Card = ({ card }) => {
  return (
    <div className="card">
      <img src={`/images/cards/${card}.png`} alt="" />
    </div>
  );
}

const Cards = () => {
  const cards = [0, 1, 2, 3, 4];

  return (
    <div className="cards">
      <Card card={cards[0]}/>
      <Card card={cards[1]}/>
      <Card card={cards[2]}/>
      <Card card={cards[3]}/>
      <Card card={cards[4]}/>
    </div>
  );
}

export default Cards
