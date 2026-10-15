import userAvatar from '../assets/user.png';

export function PatientTable({ data }) {
  return (
    <div className="overflow-x-auto w-full bg-white rounded-lg">
      {data && data.length >= 1 ? (
        <table className="relative w-full table-auto border-collapse">
          <div className="h-3 w-full bg-background absolute"></div>
          <thead className="w-full rounded-lg bg-white">
            <tr>
              <th className="text-text text-xs font-normal h-12 px-4 leading-[48px] truncate h-12 text-ellipsis text-left"></th>
              <th className="text-text text-xs font-normal h-12 px-4 leading-[48px] truncate h-12 text-ellipsis text-left">Nome</th>
              <th className="text-text text-xs font-normal h-12 px-4 leading-[48px] truncate h-12 text-ellipsis text-left">Email</th>
              <th className="text-text text-xs font-normal h-12 px-4 leading-[48px] truncate h-12 text-ellipsis text-left">Data de Nascimento</th>
            </tr>
          </thead>
          <br />
          <tbody className="w-full bg-white">
            {data.map(row => {
              const [year, month, day] = row.birth_date.split('-');
              const date = new Date(year, month - 1, day);
              const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
              const formattedDate = date.toLocaleDateString('pt-BR', options);

              return (
                <tr key={row.id} className="w-full border-b border-box">
                  <td className="h-12 ">
                    <img src={row.avatar ? row.avatar : userAvatar} alt="Avatar" className="size-8 mx-4" />
                  </td>
                  <td className="text-xs h-12 px-4 leading-[48px] text-text truncate h-12 text-ellipsis">
                    {row.name}
                  </td>
                  <td className="text-xs h-12 px-4 leading-[48px] text-text truncate h-12 text-ellipsis">
                    {row.email}
                  </td>
                  <td className="text-xs h-12 px-4 leading-[48px] text-text truncate h-12 text-ellipsis">
                    {row.birth_date && formattedDate}
                  </td>
                </tr>
              );
            })}
          </tbody>
        </table>
      ) : (
        <div className="text-text leading-[48px] text-center">Nenhuma paciente cadastrada</div>
      )}
      <div className="w-full bg-white h-12 rounded-tfoot"></div>
    </div>
  );
};
