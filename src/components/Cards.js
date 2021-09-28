
const Card = ({ card }) => {
  return (
    <div className="card">
      <label htmlFor={`img${card}`}>
        <img className="pointer-active" id="" src={`/images/cards/${card}.png`} alt="" />
      </label>
      <input id={`img${card}`} type="checkbox" />かえる
    </div>
  );
}

const Cards = ({ cards }) => {
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
