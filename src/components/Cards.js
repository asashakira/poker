
const Card = ({ card, judge }) => {
  return (
    <div className="card">
      <label htmlFor={`img-${card}`}>
        <img className="pointer-active" src={`/images/cards/${card}.png`} alt="" />
      </label>
      {judge ? (
        <></>
      ) : (
        <>
          <input id={`img-${card}`} type="checkbox" />かえる
        </>
      )}
    </div>
  );
}

const Cards = ({ cards, judge }) => {
  return (
    <div className="cards">
      {
        cards.map(card => (
          <Card key={`card${card}`} card={card} judge={judge} />
        ))
      }
    </div>
  );
}

export default Cards
