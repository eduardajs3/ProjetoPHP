import React from 'react';

export const PatientRow = ({ patient }) => {
  return (
    <tr className="border-b border-gray-300">
      <td className="px-6 py-4">
        <img
          src="https://s3-alpha-sig.figma.com/img/7c60/8b8e/102494a619feddadf521b35db7f4030c?Expires=1731888000&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=XetpHUV9AgM7bHR4ujmMPDA3GJjGx1Nz5TH2A-PUpEp-THTcI4IRD0LqUoGusywaEjAa5o-0zUqyoloN8Zb6yl7zuGSmFNfKnsRMYoBTRnlEtMCXqgL6vmprBWUTk7PEPK-AjaWRv7uUPp1YkV~VXhfezzZ6awMvWUuLW8aFlSsdF-WWVXSgINXrYIPE9unuLnHC7tdJbiMv5zQM4XSfz-S0RRPw0Nr49wnv-mOz6v1NgfoWrbv5EWL9AUk15MVA3UkfwW-gMq-sMEeYVPIeKGWRVzBbNTkNQdSswRyjth30gY0v3rtG9amhtIxBbf2NtQ1tNMqBGtAn3W7ZolBwcg__"
          alt="Avatar"
          className="w-7 h-7 rounded-full"
        />
      </td>
      <td className="px-4 py-4" style={{ color: '#9CA3AF', width: '25%' }}>{patient.name}</td>
      <td className="px-5 py-4" style={{ color: '#9CA3AF', width: '35%' }}>{patient.email}</td>
      <td className="px-7 py-4" style={{ color: '#9CA3AF', width: '25%' }}>{patient.dateOfBirth}</td>
    </tr>
  );
};
