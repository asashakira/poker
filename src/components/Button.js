
const Button = ({ onClick, judge }) => {
  return (
    <>
      {judge ? (
        <div className="btn-wrap">
          <button onClick={onClick}>はい</button>
          <button onClick={onClick}>いいえ</button>
        </div>
      ) : (
        <div className="btn-wrap">
          <button id="change" onClick={onClick}>くばる</button>
        </div>
      )}
    </>
  );
}

export default Button
