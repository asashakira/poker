
const RankTable = ({ ranks }) => {
  return (
    <div id="rank-table">
      {
        ranks.map((rank) => (
          <div key={rank.id} className="rank">
            <div className="rank-name">{rank.text}</div>
            <div className="rank-coins">{rank.bet}</div>
          </div>
        )).slice(1).reverse()
      }
    </div>
  );
}

export default RankTable
