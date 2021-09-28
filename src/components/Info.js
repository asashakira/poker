
const Coin = () => {
  return (
    <div className="info">
      <div className="info-title"> COIN </div>
      <div className="info-detail" id="coin">
        10000
      </div>
    </div>
  );
}

const Bet = () => {
  return (
    <div className="info">
      <div className="info-title"> BET </div>
      <div className="info-detail" id="bet">
        100
      </div>
    </div>
  );
}

const Info = () => {
  return (
    <div className="info-wrap">
      <Coin />
      <Bet />
    </div>
  );
}

export default Info
